<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RomanNumberService;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class RomanNumberController extends Controller
{
    public function index() {
        return Inertia::render('SiteIndex', [
                    'canLogin' => Route::has('login'),
                     'canRegister' => Route::has('register'),
                     'laravelVersion' => Application::VERSION,
                     'phpVersion' => PHP_VERSION,
                 ]);
    }
}
