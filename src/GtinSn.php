<?php 

namespace Gaesi\Validator;

class GtinSn 
{
    public static function validate(string $gtinSn): bool
    {
        return GS1::validateSscc($gtinSn);
    }
}