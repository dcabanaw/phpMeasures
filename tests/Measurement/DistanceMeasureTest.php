<?php
class DistanceMeasureTest extends PHPUnit_Framework_TestCase {

    public function testObjectCreation()
    {
        $length = new \Measurement\Distance('1','inch');
        $this->assertInstanceOf('\Measurement\Distance',$length);
        $this->assertInstanceOf('\Measurement\Measure',$length);

    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationWithUnknownUnit()
    {
        $length = new \Measurement\Distance('1','inchees');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnkownUnit()
    {
        $length = new \Measurement\Distance('1','inch');
        $length->getFactor('metress');
    }

    public function testIsEqualTo()
    {
        $length_one = new \Measurement\Distance('1','inch');
        $length_two = new \Measurement\Distance('0.0254','m');
        $this->assertTrue($length_one->isEqualTo($length_two), "{$length_one} is not equal to {$length_two}" );

        $length_one = new \Measurement\Distance('1','inch');
        $length_two = new \Measurement\Distance('0.0254000000001','m');
        $this->assertFalse($length_one->isEqualTo($length_two), "{$length_one} is equal to {$length_two}" );
    }

    public function testIsLessThan()
    {
        $length_one = new \Measurement\Distance('1','inch');
        $length_two = new \Measurement\Distance('1.5','inch');
        $this->assertTrue($length_one->isLessThan($length_two), "{$length_one} is not less than {$length_two}");

        $length_one = new \Measurement\Distance('1','inch');
        $length_two = new \Measurement\Distance('1.5','inch');
        $this->assertFalse($length_two->isLessThan($length_one), "{$length_one} is less than {$length_two}");
    }

    public function testIsGreaterThan()
    {
        $length_one = new \Measurement\Distance('1.5','inch');
        $length_two = new \Measurement\Distance('1','inch');
        $this->assertTrue($length_one->isGreaterThan($length_two), "{$length_one} is not greater than {$length_two}");

        $length_one = new \Measurement\Distance('1.5','inch');
        $length_two = new \Measurement\Distance('1','inch');
        $this->assertFalse($length_two->isGreaterThan($length_one), "{$length_one} is greater than {$length_two}");
    }

    public function testToUnit()
    {
        $distance = new \Measurement\Distance('1','m');
        $factors = $distance->getAllFactors();
        foreach ($factors as $unit => $factor) {
            for ($i=0; $i < 1001; $i++) {
                $value = (string)($i/10);
                $length_one = new \Measurement\Distance($value,$unit);
                $length_two = $length_one->toUnit('m');
                $this->assertTrue($length_one->isEqualTo($length_two), "{$length_one} is not equal to {$length_two}" );
            }
        }

    }
}