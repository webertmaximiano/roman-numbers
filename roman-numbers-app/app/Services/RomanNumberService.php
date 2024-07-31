<?php

/**Principais regras 

1- As letras I, X, C, M só podem ser repetidos três vezes consecutivas. Exemplo: III = 3 e XXX = 30; 

2- No princípio subtrativo, quando duas letras são diferentes e a de menor valor antecede a de maior valor, subtraem-se os seus valores. Exemplo: IV (5 – 1) = 4 e XLV (55 - 10) = 45; 

3- No princípio aditivo, quando duas letras são diferentes e a de maior valor antecede a de menor valor, somam-se os seus valores. Exemplo: VI (5 + 1) = 6 e LIII (50 + 3) = 53; 

4- Colocando-se um traço sobre uma ou mais letras, seu valor é multiplicado por 1.000;
https://www.educamaisbrasil.com.br/enem/matematica/numeros-romanos
*/
namespace App\Services;

use App\Models\RomanNumber;
use Illuminate\Support\Facades\Cache;
use InvalidArgumentException;

class RomanNumberService
{
    /**
     * Converte um número arabico em número romano.
     *
     * @param int $arabic
     * @return string
     */
    public function convertToRoman($arabic): string
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

    /**
     * Converte um número romano em número arabico.
     *
     * @param string $roman
     * @return int
     */
    public function convertToArabic($roman): int
    {
        // Verificar cache primeiro
        $cacheKey = 'arabic_' . $roman;
        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }

        // Garantir que o número romano esteja em maiúsculo
        $roman = strtoupper($roman);

        // Verifique se o número romano é válido de acordo com as regras
        if (!$this->isValidRomanNumber($roman)) {
            throw new InvalidArgumentException("Número Romano Inválido: " . $roman);
        }

        // Carrega todos os registros dos números
        $romanNumerals = RomanNumber::all();
        
        //transforma a colecao em um array associativo onde as chaves são os números romanos e os valores são os números arábicos correspondentes.
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
                // Princípio aditivo: soma o valor do símbolo atual ao resultado
                $result += $romanToArabic[$symbol];
                $i++;
            } else {
                // Lida com números inválidos
                throw new \InvalidArgumentException("Número Romano Inválido: ". $roman);

            }
        }

        // Armazenar em cache
        Cache::put($cacheKey, $result, 60 * 60); // Armazenar por 1 hora

        return $result;
    }

    /**
     * Verifica se o número romano informado é válido com base nas regras dos números romanos.
     *
     * @param string $roman
     * @return bool
     */
    private function isValidRomanNumber($roman): bool
    {
        // Verifica se contém apenas caracteres romanos válidos
        if (!preg_match('/^[IVXLCDM]+$/', $roman)) {
            return false;
        }

        // Verifica se o número romano segue as regras tradicionais
        $patterns = [
            'M{0,3}',              // 1000 - 3000
            '(CM|CD|D?C{0,3})',    // 900, 400, 0-300
            '(XC|XL|L?X{0,3})',    // 90, 40, 0-30
            '(IX|IV|V?I{0,3})'     // 9, 4, 0-8
        ];

        $regex = '/^' . implode('', $patterns) . '$/';

        return preg_match($regex, $roman);
    }

}
