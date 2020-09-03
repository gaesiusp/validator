<?php

namespace Gaesi\Validators;

class CPF
{
    public static function validate(string $cpf): bool
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);  // remove '.' and '-'

        if (strlen($cpf) != 11) {
            return false;
        }

        $invalid = '/0{11}|1{11}|2{11}|3{11}|4{11}|5{11}|6{11}|7{11}|8{11}|9{11}/';

        if (preg_match($invalid, $cpf)) {
            return false;
        }

        $CPFsplit = array();
        $CPFsplit = str_split($cpf);

        // check the first verification digit (modulus 11)

        $soma = 0;

        $n = 10;

        for ($i = 0; $i <= 8; $i++) {
            $soma += $CPFsplit[$i] * ($n - $i);
        }

        if (($soma % 11) < 2) {  // remainder 0 or 1 digit is 0
            $dv1 = 0;
        } else {
            $dv1 = 11 - ($soma % 11);
        }

        // if the first is right check the second digit (modulus 11)

        if ($dv1 == $CPFsplit[9]) {
            $soma = 0;

            $n = 11;

            for ($i = 0; $i <= 9; $i++) {
                $soma += $CPFsplit[$i] * ($n - $i);
            }

            if (($soma % 11) < 2) {  // remainder 0 or 1 digit is 0
                $dv2 = 0;
            } else {
                $dv2 = 11 - ($soma % 11);
            }

            // if the second is right return true

            if ($dv2 == $CPFsplit[10]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function format(string $cpf): string
    {
        $cpf = preg_replace('/[^0-9]/', '', $cpf);  // remove '.' and '-'

        return substr($cpf, 0, 3) . '.' .
            substr($cpf, 3, 3) . '.' .
            substr($cpf, 6, 3) . '-' .
            substr($cpf, 9, 2);
    }
}