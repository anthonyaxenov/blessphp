<?php

declare(strict_types = 1);

use App\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Application routes
|--------------------------------------------------------------------------
|
| Define here some routes you need to build your awesome project.
| Use FlightPHP docs to learn how to do it in correct way:
| https://flightphp.com/learn#routing
|
*/

Flight::route('/', [new HomeController(), 'home']);
Flight::route('/phpinfo', function () {
    phpinfo();
});
