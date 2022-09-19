<?php

declare(strict_types = 1);

namespace App\Controllers;

use Exception;

/**
 * Sample controller
 */
class HomeController extends Controller
{
    /**
     * Shows the main page
     *
     * @throws Exception
     */
    public function home(): void
    {
        view('home');
    }
}
