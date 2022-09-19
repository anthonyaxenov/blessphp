<?php

declare(strict_types = 1);

/*
|--------------------------------------------------------------------------
| Entry point of your application
|--------------------------------------------------------------------------
*/

require '../vendor/autoload.php';

App\Core\Bootstrapper::setUp();

Flight::start();
