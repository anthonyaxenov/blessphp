<?php

declare(strict_types = 1);

return [
    'flight' => [
        // https://flightphp.com/learn#configuration
        'base_url' => env('APP_URL', 'http://localhost:8888'),
        'case_sensitive' => bool(env('FLIGHT_CASE_SENSITIVE', false)),
        'handle_errors' => bool(env('FLIGHT_HANDLE_ERRORS', true)),
        'log_errors' => bool(env('FLIGHT_LOG_ERRORS', true)),
        'views' => [
            'path' => views_path(),
            'extension' => '.twig',
        ],
    ],
    'twig' => [
        'cache' => bool(env('TWIG_CACHE', true)) ? cache_path() . '/views' : false,
        'debug' => bool(env('TWIG_DEBUG', false)),
    ],
    'app' => [
        'title' => env('APP_TITLE', 'BlessPHP'),
        'lang' => 'en', // one of ../i18n/*
        'timezone' => 'UTC', // one of https://www.php.net/manual/en/timezones.php
    ],
];
