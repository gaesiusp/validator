# Gaesi/validator

A PHP library for General Validations.

Validations:
 - Cpf;
 - Cnpj;
 - CEP;
 - GS1 (Gtin, Sscc, GtinWithSn);
 - Check digit (mod 10, mod 11 and mod 37) 

 ## Use

 ````
 use Gaesi\Validator;

 CPF::validate("12345678909");
 CNPJ::validate("12345678900109");
 GS1::validateGs1("1234567890123");
 ````

