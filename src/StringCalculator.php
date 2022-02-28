<?php

namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    public function add(String $number): String
    {
        if(empty($number)){
            return 0;
        }

        $delimiters = ",\n";
        $positionOfCustomDelimiterAndNumbersSeparator = 0;
        if($number[0] == "/" && $number[1] == "/"){
            $positionOfCustomDelimiterAndNumbersSeparator = strpos($number, "\n");
            $delimiters = substr($number, 2, $positionOfCustomDelimiterAndNumbersSeparator - 1);

        }
        $numbers = substr($number, $positionOfCustomDelimiterAndNumbersSeparator);

        $badUseOfSeparatorsChecked = $this->checkOutBadUsedSeparators($numbers);
        if($badUseOfSeparatorsChecked[0]){
            return "Number expected but " . $badUseOfSeparatorsChecked[1] . " found at position " . $badUseOfSeparatorsChecked[2];
        }

        $separatorInLastPosition = $this->checkOutSeparatorInLastPosition($numbers);

        if($separatorInLastPosition){
            return "Number expected but EOF found";
        }


        $separatedNumber = preg_split("/[$delimiters]/", $numbers);
        $sum = 0;
        for($i = 0; $i < count($separatedNumber); $i++){
            $sum += floatval($separatedNumber[$i]);
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

    public function checkOutSeparatorInLastPosition($number): bool{
        if($number[strlen($number) - 1] == "," || $number[strlen($number) - 1] == "\n"){
            return true;
        }
        else{
            return false;
        }
    }

}