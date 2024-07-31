<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RomanNumberService;

use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class RomanNumberController extends Controller
{
    protected $romanNumberService;

    // Injeção de dependência via construtor
    public function __construct(RomanNumberService $romanNumberService)
    {
        $this->romanNumberService = $romanNumberService;
    }

    public function index() {
        return Inertia::render('SiteIndex', [
                    'canLogin' => Route::has('login'),
                     'canRegister' => Route::has('register'),
                     'laravelVersion' => Application::VERSION,
                     'phpVersion' => PHP_VERSION,
                 ]);
    }

    public function convertToRoman(Request $request): string
    {
        //validar se o valor e um numero inteiro
        dd($request->value);
    }

    public function convertToArabic(Request $request): int
    {
        dd($request);
    }
}
