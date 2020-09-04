<?php 

namespace Gaesi\Validator;

class Mod10
{
    /**
     * Verifica se o dígito verificador de um número é um Módulo 10 Válido  
     * 
     * @param string Número com o dígito verificador 
     * 
     * @return bool Retorna true caso o DV válido e false caso inválido 
     */
    public static function validate(string $number): bool
    {
        $len = strlen($number);
        $n = substr($number, 0, ($len - 1));
        $dv = substr($number, $len - 1, $len-1);
        return Mod10::calculate($n) === $dv;
    }

    /**
     * Calcula o dígito verificador de um número usando Módulo 10    
     * 
     * @param string Número 
     * 
     * @return bool Retorna o dígito verificador
     */
    public static function calculate(string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        $number_array = str_split((string) $number);
        $number_array_reverse = array_reverse($number_array);
        $doubled_array = array();
        foreach ($number_array_reverse as $index => $digit) {
            if ($index % 2) { // if odd
                $doubled_array[] = $digit;
            } else {
                if (($digit * 2) > 9) {
                    $doubled_digit_array = str_split((string) ($digit * 2));
                    $doubled_array[] = array_sum($doubled_digit_array);
                } else {
                    $doubled_array[] = $digit * 2;
                }
            }
        }
        return (array_sum($doubled_array) * 9) % 10;
    }
}