<?php 

namespace Gaesi\Validators;

class SSCC 
{
    public static function validate(string $sscc) : bool
    {
        return GS1::validateSscc($sscc);
    }
}