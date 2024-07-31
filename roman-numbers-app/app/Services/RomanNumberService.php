<?php

/**Principais regras 

1- As letras I, X, C, M só podem ser repetidos três vezes consecutivas. Exemplo: III = 3 e XXX = 30; 

2- No princípio subtrativo, quando duas letras são diferentes e a de menor valor antecede a de maior valor, subtraem-se os seus valores. Exemplo: IV (5 – 1) = 4 e XLV (55 - 10) = 45; 

3- No princípio aditivo, quando duas letras são diferentes e a de maior valor antecede a de menor valor, somam-se os seus valores. Exemplo: VI (5 + 1) = 6 e LIII (50 + 3) = 53; 

4- Colocando-se um traço sobre uma ou mais letras, seu valor é multiplicado por 1.000;
namespace Database\Seeders;
https://www.educamaisbrasil.com.br/enem/matematica/numeros-romanos
*/
namespace App\Services;

use App\Models\RomanNumber;
use Illuminate\Support\Facades\Cache;

class RomanNumberService
{
    public function convertToRoman($arabic)
    {
        // Verificar cache primeiro
        $cacheKey = 'roman_' . $arabic;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Busca todos números romanos em ordem decrescente pelos números arábicos
        $romanNumbers = RomanNumber::orderBy('arabic', 'desc')->get();
        $result = '';

        foreach ($romanNumbers as $romanNumber) {
            while ($arabic >= $romanNumber->arabic) {
                $result .= $romanNumber->roman;
                $arabic -= $romanNumber->arabic;
            }
        }

        // Armazenar em cache
        Cache::put($cacheKey, $result, 60 * 60); // Armazenar por 1 hora

        return $result;
    }

    public function convertToArabic($roman)
    {
        // Verificar cache primeiro
        $cacheKey = 'arabic_' . $roman;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Garantir que o número romano esteja em maiúsculo
        $roman = strtoupper($roman);

        // Carrega todos os registros dos números
        $romanNumerals = RomanNumber::all();
        $romanToArabic = $romanNumerals->pluck('arabic', 'roman')->toArray();

        $result = 0;
        $i = 0;
        $length = strlen($roman);

        while ($i < $length) {
            // Pegar o símbolo corrente e o próximo se existir
            $symbol = $roman[$i];
            $nextSymbol = $i + 1 < $length ? $roman[$i + 1] : null;

            // Verificar a combinação atual e se o próximo símbolo está na tabela (princípio subtrativo)
            if ($nextSymbol && isset($romanToArabic[$symbol . $nextSymbol])) {
                $result += $romanToArabic[$symbol . $nextSymbol];
                $i += 2; // Passa para o próximo símbolo
            } elseif (isset($romanToArabic[$symbol])) {
                // Caso contrário, use apenas o símbolo atual
                $result += $romanToArabic[$symbol];
                $i++;
            } else {
                // Lida com números inválidos
                throw new \InvalidArgumentException("Número Romano Inválido: $roman");
            }
        }

        // Armazenar em cache
        Cache::put($cacheKey, $result, 60 * 60); // Armazenar por 1 hora

        return $result;
    }
}
