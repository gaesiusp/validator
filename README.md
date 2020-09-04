# Gaesi/validator

A PHP library for General Validations.

Validations:
 - Cpf;
 - Cnpj;
 - GS1 (Gtin, Sscc, GtinWithSn);
 - Check digit (mod 10, mod 11 and mod 37) 

 ## Usage

 ```` php
<?php

use Gaesi\Validator\CPF;
use Gaesi\Validator\GS1;
use Gaesi\Validator\Mod11;

CPF::validate("12345678909");      // return true
GS1::validateGs1("1234567890123"); // return false
Mod11::calcule("111222333");       // return "1112223339"
Mod11::validate("1112223339");     // return true 
 ````

