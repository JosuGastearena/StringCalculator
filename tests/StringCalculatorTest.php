<?php



namespace Deg540\PHPTestingBoilerplate\Test;
use PHPUnit\Framework\TestCase;
use Deg540\PHPTestingBoilerplate\StringCalculator;

class StringCalculatorTest extends TestCase
{
    /**
     * @test
     */
    public function given_an_empty_string_return_0(){

        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("");
        $this->assertEquals(0, $calculatedString);

    }

    /**
     * @test
     */
    public function given_a_1_return_1(){

        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1");
        $this->assertEquals(1, $calculatedString);

    }

    /**
     * @test
     */
    public function given_max_2_numbers_return_their_sum(){

        $stringCalculator = new StringCalculator();
        $calculatedString = $stringCalculator->add("1.1,2.2");
        $this->assertEquals(3.3, $calculatedString);

    }


}
