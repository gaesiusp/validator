<?php 

namespace Gaesi\Validator;

class GS1
{
    public static function validateGtin(string $gtin, int $length = 14): bool
    {
        if( isset($gtin) && strlen($gtin) == $length){
            return GS1::validateGs1($gtin);
        } 
        return false;
    }
    
    public static function validateGtinSn(string $gtinsn): bool
    {
        return true;
        // $gtin = substr($gtinsn, 0, 14);
        // $sn = substr($gtinsn, 14);
        // return valid_gtin($gtin);
    }
    
    public static function validateSscc(string $sscc): bool
    {
        if (isset($sscc)){
            if (strlen($sscc) == 20) 
                $sscc = substr($sscc, 2);
            if (strlen($sscc) !== 18)
                return false;
            return GS1::validateGs1($sscc);
        }
    }
    
    public static function validateGs1(string $gs1): bool
    {
        if( isset($gs1) && strlen($gs1) > 7 && strlen($gs1) < 19 ){
            $check = substr($gs1, strlen($gs1)-1);
            $total = 0;
            for ($i=0; $i < strlen($gs1)-1; $i++) {
                if(strlen($gs1) % 2 == 0) 
                    $total += ($i % 2)? $gs1[$i] * 1: $gs1[$i] * 3;
                else
                    $total += ($i % 2)? $gs1[$i] * 3: $gs1[$i] * 1;
            }
            $dv = 10 - ($total % 10);
            if ($dv == 10) $dv = 0;
            if($check == $dv)
                return true;
        } 
        return false;
    }
}