<?php 

namespace Gaesi\Validators;

class CheckDigit
{
    public static function validateMod10(string $number): bool
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

    public static function validateMod11(string $number): bool
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

    public static function validateMod37(string $number): bool
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
    
        return base_convert($dv, 10, 36);
    }
}