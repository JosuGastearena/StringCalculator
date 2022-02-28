<?php

namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    public function add(String $number): String
    {
        if(empty($number)){
            return 0;
        }

        $badUseOfSeparatorsChecked = $this->checkOutBadUsedSeparators($number);
        if($badUseOfSeparatorsChecked[0]){
            return "Number expected but " . $badUseOfSeparatorsChecked[1] . " found at position " . $badUseOfSeparatorsChecked[2];
        }

        $numberSeparatorsPrepared = str_replace("\n", ",", $number);
        $comaSeparatedNumber = explode(",", $numberSeparatorsPrepared);
        $sum = 0;
        for($i = 0; $i < count($comaSeparatedNumber); $i++){
            $sum += $comaSeparatedNumber[$i];
        }
        return $sum;

    }

    public function checkOutBadUsedSeparators($number): array
    {
        if(str_contains($number, ",,")){
            return [true, ",", (strpos($number, ",,") + 1)];
        }
        else if(str_contains($number, ",\n")){
            return [true, "\n", (strpos($number, ",\n") + 1)];
        }
        else if(str_contains($number, "\n\n")){
            return [true, "\n", (strpos($number, ",\n") + 1)];
        }
        else if(str_contains($number, "\n,")){
            return [true, ",", (strpos($number, "\n,") + 1)];
        }
        return [false, "", ""];
    }

}