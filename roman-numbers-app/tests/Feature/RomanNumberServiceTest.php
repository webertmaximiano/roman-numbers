<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\RomanNumberService;
use App\Models\RomanNumber;
use Database\Seeders\RomanNumberAndArabicSeeder;


class RomanNumberServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        //executar o seed povoando o banco de dados
         // Run the seeder
         $this->seed(RomanNumberAndArabicSeeder::class);
       
    }

    public function test_convertToRoman()
    {
        $service = new RomanNumberService();

        $this->assertEquals('I', $service->convertToRoman(1));
        $this->assertEquals('IV', $service->convertToRoman(4));
        $this->assertEquals('IX', $service->convertToRoman(9));
        $this->assertEquals('XLII', $service->convertToRoman(42));
        $this->assertEquals('XCIX', $service->convertToRoman(99));
        $this->assertEquals('MMXXI', $service->convertToRoman(2021));
    }

    public function test_convertToArabic()
    {
        $service = new RomanNumberService();

        $this->assertEquals(1, $service->convertToArabic('I'));
        $this->assertEquals(4, $service->convertToArabic('IV'));
        $this->assertEquals(9, $service->convertToArabic('IX'));
        $this->assertEquals(42, $service->convertToArabic('XLII'));
        $this->assertEquals(99, $service->convertToArabic('XCIX'));
        $this->assertEquals(2021, $service->convertToArabic('MMXXI'));
    }


}
