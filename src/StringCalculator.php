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
        if(count($comaSeparatedNumber) == 1){
            return $comaSeparatedNumber[0];
        }

        return $comaSeparatedNumber[0] + $comaSeparatedNumber[1];

    }

}