<?php 

namespace Gaesi\Validator;

class Mod37
{
     /**
     * Verifica se o dígito verificador de um número é um Módulo 37 Válido  
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
        return Mod37::calculate($n) === $dv;
    }

    /**
     * Calcula o dígito verificador de um número usando Módulo 37 
     * 
     * @param string Número  
     * 
     * @return string Retorna o dígito verificador
     */
    public static function calculate(string $number): string
    {
        $number = preg_replace('/[^A-Za-z0-9]/', '', $number);

        $number_array = str_split((string) $number);
    
        $number_array_reverse = array_reverse($number_array);
    
        $multiplied_array = array();
    
        foreach ($number_array_reverse as $index => $digit) {
            $multiplied_array[] = base_convert($digit, 36, 10) * ($index + 2);
        }
    
        $dv = 37 - (array_sum($multiplied_array) % 37);
        if ( $dv > 35 ){ $dv = 0; }
    
        return strtoupper(base_convert($dv, 10, 36));
    }
}