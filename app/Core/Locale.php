<?php

namespace App\Core;

use Illuminate\Support\Arr;

/**
 * Locale class needed to use translations in project
 */
class Locale
{
    /**
     * @var array Loaded raw strings map
     */
    protected array $strings;

    /**
     * Instantiate locale with specific $code
     *
     * @param string $code
     */
    public function __construct(protected string $code)
    {
        $this->strings = $this->load();
    }

    /**
     * Reads and returns translation strings
     *
     * @return array
     */
    protected function load(): array
    {
        $strings = [];
        foreach (glob(root_path("i18n/$this->code/*.php")) as $file) {
            $file_key = str_replace('.php', '', basename($file));
            $strings[$file_key] = require $file;
        }
        return Arr::dot($strings);
    }

    /**
     * Returns one of loaded raw strings by key or key itself if string not found
     *
     * @param string $key
     * @return string
     */
    protected function raw(string $key): string
    {
        return $this->strings[$key] ?? $key;
    }

    /**
     * Returns one of loaded strings with replacements made according to map by key or key itself if string not found
     *
     * @param string $key
     * @param array $replacements
     * @return string|null
     */
    public function get(string $key, array $replacements = []): ?string
    {
        $string = $this->raw($key);
        if ($replacements) {
            $string = str_replace(array_keys($replacements), array_values($replacements), $string);
        }
        return $string;
    }

    /**
     * Returns current locale code
     *
     * @return string
     */
    public function code(): string
    {
        return $this->code;
    }
}
