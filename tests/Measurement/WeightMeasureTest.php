<?php
class WeightMeasureTest extends PHPUnit_Framework_TestCase {

    public function testObjectCreation()
    {
        $weight = new \Measurement\Weight('1','g');
        $this->assertInstanceOf('\Measurement\Weight',$weight);
        $this->assertInstanceOf('\Measurement\Measure',$weight);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationWithUnknownUnit()
    {
        $weight = new \Measurement\Weight('1','aaaaa');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnkownUnit()
    {
        $weight = new \Measurement\Weight('1','aaaaaa');
        $weight->getFactor('metress');
    }

    public function testIsEqualTo()
    {
        $weight_one = new \Measurement\Weight('1','lb');
        $weight_two = new \Measurement\Weight('453.592','g');
        $this->assertTrue($weight_one->isEqualTo($weight_two), "{$weight_one} is not equal to {$weight_two}" );

        $weight_one = new \Measurement\Weight('1','lb');
        $weight_two = new \Measurement\Weight('453.592000000001','g');
        $this->assertFalse($weight_one->isEqualTo($weight_two), "{$weight_one} is equal to {$weight_two}" );
    }

    public function testIsLessThan()
    {
        $weight_one = new \Measurement\Weight('1','lb');
        $weight_two = new \Measurement\Weight('1.5','lb');
        $this->assertTrue($weight_one->isLessThan($weight_two), "{$weight_one} is not less than {$weight_two}");

        $weight_one = new \Measurement\Weight('1','lb');
        $weight_two = new \Measurement\Weight('1.5','lb');
        $this->assertFalse($weight_two->isLessThan($weight_one), "{$weight_one} is less than {$weight_two}");
    }

    public function testIsGreaterThan()
    {
        $weight_one = new \Measurement\Weight('1.5','lb');
        $weight_two = new \Measurement\Weight('1','lb');
        $this->assertTrue($weight_one->isGreaterThan($weight_two), "{$weight_one} is not greater than {$weight_two}");

        $weight_one = new \Measurement\Weight('1.5','lb');
        $weight_two = new \Measurement\Weight('1','lb');
        $this->assertFalse($weight_two->isGreaterThan($weight_one), "{$weight_one} is greater than {$weight_two}");
    }

    public function testToUnit()
    {
        $weight = new \Measurement\Weight('1','g');
        $factors = $weight->getAllFactors();
        foreach ($factors as $unit => $factor) {
            for ($i=0; $i < 1001; $i++) {
                $value = (string)($i/10);
                $weight_one = new \Measurement\Weight($value,$unit);
                $weight_two = $weight_one->toUnit('g');
                $this->assertTrue($weight_one->isEqualTo($weight_two), "{$weight_one} is not equal to {$weight_two}" );
            }
        }

    }
}