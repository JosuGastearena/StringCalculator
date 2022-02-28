<?php

namespace Deg540\PHPTestingBoilerplate;

class StringCalculator
{
    public function add(String $number): String
    {
        if(empty($number)){
            return 0;
        }
        $numberSeparatorsPrepared = str_replace("\n", ",", $number);
        $comaSeparatedNumber = explode(",", $numberSeparatorsPrepared);
        $sum = 0;
        for($i = 0; $i < count($comaSeparatedNumber); $i++){
            $sum += $comaSeparatedNumber[$i];
        }
        return $sum;

    }

}