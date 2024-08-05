<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RomanNumberService;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

class RomanNumberController extends Controller
{
    protected $service;

    // Injeção de dependência via construtor
    public function __construct(RomanNumberService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        return Inertia::render('SiteIndex', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'result' => null,
        ]);
    }

    public function convertToRoman(Request $request)
    {
        // Validar se o valor é um número inteiro
        $validated = $request->validate([
            'value' => 'required|integer|min:1'
        ]);

        $result = $this->service->convertToRoman($validated['value']);

        return Inertia::render('SiteIndex', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'result' => $result,
        ]);
    }

    public function convertToArabic(Request $request)
    {
        $validated = $request->validate([
            'value' => 'required|string'
        ]);

        try {
            $result = $this->service->convertToArabic($validated['value']);
        } catch (\InvalidArgumentException $e) {
            $result = $e->getMessage();
        }

        return Inertia::render('SiteIndex', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'laravelVersion' => Application::VERSION,
            'phpVersion' => PHP_VERSION,
            'result' => $result,
        ]);
    }
}
