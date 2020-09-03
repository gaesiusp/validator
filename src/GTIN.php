<?php 

namespace Gaesi\Validators;

class GTIN
{
    public static function validate(string $gtin, int $length = 14) : bool
    {
        return GS1::validateGtin($gtin, $length);
    }
}