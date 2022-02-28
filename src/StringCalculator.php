<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    public function add(String $number): String
    {
        if(empty($number)){
            return 0;
        }
        $comaSeparatedNumber = explode(",", $number);
        $suma = 0;
        for($i = 0; $i < count($comaSeparatedNumber); $i++){
            $suma += $comaSeparatedNumber[$i];
        }

        return $suma;

    }

}