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
        $validated = $request->validate([
            'value' => 'required|integer|min:1'
        ]);

        $roman = $this->service->convertToRoman($validated['value']);
        // Retorne o resultado 
        //return response()->json(['roman' => $roman]); 
        return back()->with([
            'success' => 'Numero convertido com Suvesso',
            'roman' => $roman
        ]);
    }

    public function convertToArabic(Request $request): int
    {
        dd($request);
    }
}
