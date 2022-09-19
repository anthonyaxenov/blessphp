<?php

declare(strict_types = 1);

namespace App\Core;

use Flight;
use Illuminate\Support\Arr;
use Symfony\Component\Dotenv\Dotenv;
use Twig\{
    Environment,
    Extension\DebugExtension,
    Loader\FilesystemLoader,
};

/**
 * Main class that bootstraps all the application
 */
class Bootstrapper
{
    /**
     * Loads settings from config/app.php
     *
     * @return void
     */
    protected static function bootSettings(): void
    {
        (new Dotenv())->loadEnv(root_path('.env'));
        $settings = Arr::dot(require_once config_path('app.php'));
        Arr::map($settings, function ($value, $key) {
            Flight::set("flight.$key", $value);
        });
        Flight::set('config', $settings);
        Flight::set('locale', new Locale($settings['app.lang']));
        date_default_timezone_set($settings['app.timezone']);
    }

    /**
     * Sets up Twig template engine
     *
     * @return void
     */
    protected static function bootTwig(): void
    {
        $filesystemLoader = new FilesystemLoader(config('views.path'));
        Flight::register(
            'view',
            Environment::class,
            [$filesystemLoader, config('twig')],
            function ($twig) {
                /** @var Environment $twig */
                Flight::set('twig', $twig);
                $twig->addExtension(new TwigFunctions());
                $twig->addExtension(new DebugExtension());
            }
        );
    }

    /**
     * Set up application before Flight::start()
     *
     * @return void
     */
    public static function setUp(): void
    {
        static::bootSettings();
        static::bootTwig();
        require_once config_path('routes.php');
    }
}
