<?php

namespace Gaesi\Validator;

class CNPJ
{
    public static function validate(string $cnpj): bool
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);  // remove '.', '-' and '/'

        if (strlen($cnpj) != 14) {
            return false;
        }

        $invalid = '/0{14}|1{14}|2{14}|3{14}|4{14}|5{14}|6{14}|7{14}|8{14}|9{14}/';

        if (preg_match($invalid, $cnpj)) {
            return false;
        }

        $CNPJsplit = array();
        $CNPJsplit = str_split($cnpj);

        // check the first verification digit (modulus 11)

        $soma = 0;

        $n = 5;

        for ($i = 0; $i <= 3; $i++) {
            $soma += $CNPJsplit[$i] * ($n - $i);
        }

        $n = 13;

        for ($i = 4; $i <= 11; $i++) {
            $soma += $CNPJsplit[$i] * ($n - $i);
        }

        if (($soma % 11) < 2) {  // remainder 0 or 1 digit is 0
            $dv1 = 0;
        } else {
            $dv1 = 11 - ($soma % 11);
        }

        // if the first is right check the second digit (modulus 11)

        if ($dv1 == $CNPJsplit[12]) {
            $soma = 0;

            $n = 6;

            for ($i = 0; $i <= 4; $i++) {
                $soma += $CNPJsplit[$i] * ($n - $i);
            }

            $n = 14;

            for ($i = 5; $i <= 12; $i++) {
                $soma += $CNPJsplit[$i] * ($n - $i);
            }

            if (($soma % 11) < 2) {  // remainder 0 or 1 digit is 0
                $dv2 = 0;
            } else {
                $dv2 = 11 - ($soma % 11);
            }

            // if the second is right return true

            if ($dv2 == $CNPJsplit[13]) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
	 * Valida se dois CNPJs possuem relação de Matriz e Filial
	 *
	 * @param	string	$matriz CNPJ da Matriz sem pontuação
     * @param   string  $filial CNPJ da Filial sem pontuação
	 * @return	bool    Retorna true se a relação for verdadeira
	 */
    public static function validateMatrizFilial($matriz, $filial)
    {
        if( substr($matriz, 0, 8) === substr($filial, 0, 8) )
            if(substr($matriz, 8, 4) === '0001')
                return true;
        return false;
    }

    public static function format(string $cnpj): string
    {
        $cnpj = preg_replace('/[^0-9]/', '', $cnpj);  // remove '.', '-' and '/'

        return substr($cnpj, 0, 2) . '.' .
            substr($cnpj, 2, 3) . '.' .
            substr($cnpj, 5, 3) . '/' .
            substr($cnpj, 8, 4) . '-' .
            substr($cnpj, 12, 2);
    }
}