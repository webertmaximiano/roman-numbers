<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RomanNumber;

class RomanNumberAndArabicSeeder extends Seeder
{
    public function run(): void
    {

        $romanNumbers = [
            // 900000 => 'C̅M̅',
            // 500000 => 'D̅',
            // 400000 => 'C̅D̅',
            // 100000 => 'C̅',
            // 90000 => 'X̅C̅',
            // 50000 => 'L̅',
            // 40000 => 'X̅L̅',
            // 10000 => 'X̅',
            // 9000 => 'I̅X̅',
            // 5000 => 'V̅',
            // 4000 => 'I̅V̅',
            1000 => 'M',
            900 => 'CM',
            500 => 'D',
            400 => 'CD',
            100 => 'C',
            90 => 'XC',
            50 => 'L',
            40 => 'XL',
            10 => 'X',
            9 => 'IX',
            5 => 'V',
            4 => 'IV',
            1 => 'I'
        ];

        foreach ($romanNumbers as $arabic => $roman) {
            RomanNumber::create([
                'arabic' => $arabic,
                'roman' => $roman
            ]);
        }
    }
}