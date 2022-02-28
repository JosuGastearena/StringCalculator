<?php

namespace Deg540\PHPTestingBoilerplate;


class StringCalculator
{
    public function add(String $number): String
    {
        if(empty($number))
        {
            return 0;
        }

        $correctNumber = true;
        $errorString = "";
        $delimiters = ",\n";
        $positionOfCustomDelimiterAndNumbersSeparator = -1;

        if($number[0] == "/" && $number[1] == "/")
        {
            $positionOfCustomDelimiterAndNumbersSeparator = strpos($number, "\n");
            $delimiters = substr($number, 2, $positionOfCustomDelimiterAndNumbersSeparator - 2);
        }

        $numbers = substr($number, $positionOfCustomDelimiterAndNumbersSeparator + 1);

        $badUseOfSeparatorsChecked = $this->checkOutBadUsedSeparators($numbers);
        if($badUseOfSeparatorsChecked[0])
        {
            $correctNumber = false;
            if(!empty($errorString))
            {
                $errorString .= "\n";
            }
            $errorString .= "Number expected but " . $badUseOfSeparatorsChecked[1] . " found at position " . $badUseOfSeparatorsChecked[2];
        }

        $separatorInLastPosition = $this->checkOutSeparatorInLastPosition($numbers);
        if($separatorInLastPosition)
        {
            $correctNumber = false;
            if(!empty($errorString))
            {
                $errorString .= "\n";
            }
            $errorString .= "Number expected but EOF found";
        }

        $separatedNumber = preg_split('/[' . $delimiters . ']/', $numbers, -1, PREG_SPLIT_NO_EMPTY);
        $sum = 0;
        $firstNegativeFound = false;
        for($i = 0; $i < count($separatedNumber); $i++)
        {
            if(!is_numeric($separatedNumber[$i]))
            {
                $incorrectSeparator = $this->findOutIncorrectSeparator($separatedNumber[$i]);
                $correctNumber = false;
                if(!empty($errorString))
                {
                    $errorString .= "\n";
                }
                $errorString .= "'$delimiters' expected but '$incorrectSeparator' found at position " . strpos($numbers, $incorrectSeparator) . ".";
            }
            else if($separatedNumber[$i] < 0 && !$firstNegativeFound)
            {
                $negativeList = $this->manageNegativeNumbers($separatedNumber, $i);
                $correctNumber = false;
                $firstNegativeFound = true;
                if(!empty($errorString))
                {
                    $errorString .= "\n";
                }
                $errorString .= "Negative not allowed: $negativeList";
            }
            else
            {
                $sum += $separatedNumber[$i];
            }
        }
        if(!$correctNumber)
        {
            return $errorString;
        }
        return $sum;
    }

    public function checkOutBadUsedSeparators($number): array
    {
        if(str_contains($number, ",,"))
        {
            return [true, ",", (strpos($number, ",,") + 1)];
        }
        else if(str_contains($number, ",\n"))
        {
            return [true, "\n", (strpos($number, ",\n") + 1)];
        }
        else if(str_contains($number, "\n\n"))
        {
            return [true, "\n", (strpos($number, ",\n") + 1)];
        }
        else if(str_contains($number, "\n,"))
        {
            return [true, ",", (strpos($number, "\n,") + 1)];
        }
        return [false, "", ""];
    }

    public function checkOutSeparatorInLastPosition($number): bool
    {
        if($number[strlen($number) - 1] == "," || $number[strlen($number) - 1] == "\n")
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function findOutIncorrectSeparator($separatedNumbersElement): String
    {

        $permitedValues = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "."];
        $incorrectSeparator = "";
        for($i = 0; $i < strlen($separatedNumbersElement); $i++)
        {
            if(!in_array($separatedNumbersElement[$i], $permitedValues))
            {
                $incorrectSeparator = $separatedNumbersElement[$i];
            }
        }
        return $incorrectSeparator;


    }

    public function manageNegativeNumbers($separatedNumber, $index): String
    {
        $negativeList = "";
        for($i = $index; $i < count($separatedNumber); $i++)
        {
            if($separatedNumber[$i] < 0)
            {
                if(!empty($negativeList))
                {
                    $negativeList .= ", ";
                }
                $negativeList .= $separatedNumber[$i];
            }
        }
        return $negativeList;
    }
}