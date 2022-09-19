<?php

declare(strict_types = 1);

namespace App\Core;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Twig extension with custom functions to use in templates
 */
class TwigFunctions extends AbstractExtension
{
    /**
     * Returns functions to use
     *
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('_', [$this, '_']),
            new TwigFunction('config', [$this, 'config']),
            new TwigFunction('base_url', [$this, 'base_url']),
        ];
    }

    /**
     * Get config values
     *
     * @param string $key
     * @param mixed|null $default
     * @return mixed
     */
    public function config(string $key, mixed $default = null): mixed
    {
        return config($key, $default);
    }

    /**
     * Returns base URL
     *
     * @param string $path
     * @return string
     */
    public function base_url(string $path = ''): string
    {
        return base_url($path);
    }

    /**
     * Translate message by $key with optional $replacements in it
     *
     * @param string $key
     * @param array $replacements
     * @return string Key when translation is unknown
     */
    public function _(string $key, array $replacements = []): string
    {
        return _($key, $replacements);
    }
}
