<?php

namespace Deg540\PHPTestingBoilerplate\Test;
use PHPUnit\Framework\TestCase;
use Deg540\PHPTestingBoilerplate\StringCalculator;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function given_an_empty_string_return_0()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("");
        $this->assertEquals(0, $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_return_their_sum()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1.1,2.2,3.3");
        $this->assertEquals(6.6, $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_coma_and_newline_separators_return_their_sum()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1.1,2.2\n3.3");
        $this->assertEquals(6.6, $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_coma_and_nextline_separators_bad_used_return_error_message()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1.1,2.2,\n3.3");
        $this->assertEquals("Number expected but \n found at position 8", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_separator_in_last_position_return_error_message()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1,3,");
        $this->assertEquals("Number expected but EOF found", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_custom_separator_return_their_sum()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("//;\n1;2");
        $this->assertEquals("3", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_custom_separator_sep_return_their_sum()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("//sep\n1sep2sep1.5");
        $this->assertEquals("4.5", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_custom_separator_bad_used_return_error_message()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("//sep\n1sep2,1.5");
        $this->assertEquals("'sep' expected but ',' found at position 5.", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_negative_values_return_error_message()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1.5,-2,-3");
        $this->assertEquals("Negative not allowed: -2, -3", $calculatedString);
    }

    /**
     * @test
     */
    public function given_an_unknown_number_of_arguments_with_multiple_errors_return_multiple_error_message()
    {
        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1,,-2");
        $this->assertEquals("Number expected but , found at position 2\nNegative not allowed: -2", $calculatedString);
    }
}
