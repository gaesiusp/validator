<?php 

namespace Gaesi\Validator;

class Mod11
{

     /**
     * Verifica se o dígito verificador de um número é um Módulo 11 Válido  
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
        return Mod11::calculate($n) === $dv;
    }

    /**
     * Calcula o dígito verificador de um número usando Módulo 11
     * 
     * @param string Número  
     * 
     * @return string Retorna o dígito verificador
     */
    public static function calculate(string $number): string
    {
        $number = preg_replace('/[^0-9]/', '', $number);
        $number_array = str_split((string) $number);
        $number_array_reverse = array_reverse($number_array);
        $multiplied_array = array();
        foreach ($number_array_reverse as $index => $digit) {
            $multiplied_array[] = $digit * ($index + 2);
        }
        if ((array_sum($multiplied_array) % 11) < 2) {
            return 0;
        } else {
            return 11 - (array_sum($multiplied_array) % 11);
        }
    }

}