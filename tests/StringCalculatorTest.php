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

}
