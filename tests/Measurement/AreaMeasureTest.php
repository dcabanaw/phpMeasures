<?php
class AreaMeasureTest extends PHPUnit_Framework_TestCase {

    public function testObjectCreation()
    {
        $area = new \Measurement\Area('1','sq_inch');
        $this->assertInstanceOf('\Measurement\Area',$area);
        $this->assertInstanceOf('\Measurement\Measure',$area);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationWithUnknownUnit()
    {
        $area = new \Measurement\Area('1','sq_inchees');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnkownUnit()
    {
        $area = new \Measurement\Area('1','sq_inch');
        $area->getFactor('metress');
    }

    public function testIsEqualTo()
    {
        $area_one = new \Measurement\Area('1','sq_inch');
        $area_two = new \Measurement\Area('0.00064516','sq_m');
        $this->assertTrue($area_one->isEqualTo($area_two), "{$area_one} is not equal to {$area_two}" );

        $area_one = new \Measurement\Area('1','sq_inch');
        $area_two = new \Measurement\Area('0.00064516000000001','sq_m');
        $this->assertFalse($area_one->isEqualTo($area_two), "{$area_one} is equal to {$area_two}" );
    }

    public function testIsLessThan()
    {
        $area_one = new \Measurement\Area('1','sq_inch');
        $area_two = new \Measurement\Area('1.5','sq_inch');
        $this->assertTrue($area_one->isLessThan($area_two), "{$area_one} is not less than {$area_two}");

        $area_one = new \Measurement\Area('1','sq_inch');
        $area_two = new \Measurement\Area('1.5','sq_inch');
        $this->assertFalse($area_two->isLessThan($area_one), "{$area_one} is less than {$area_two}");
    }

    public function testIsGreaterThan()
    {
        $area_one = new \Measurement\Area('1.5','sq_inch');
        $area_two = new \Measurement\Area('1','sq_inch');
        $this->assertTrue($area_one->isGreaterThan($area_two), "{$area_one} is not greater than {$area_two}");

        $area_one = new \Measurement\Area('1.5','sq_inch');
        $area_two = new \Measurement\Area('1','sq_inch');
        $this->assertFalse($area_two->isGreaterThan($area_one), "{$area_one} is greater than {$area_two}");
    }

    public function testToUnit()
    {
        $area = new \Measurement\Area('1','sq_m');
        $factors = $area->getAllFactors();
        foreach ($factors as $unit => $factor) {
            for ($i=0; $i < 1001; $i++) {
                $value = (string)($i/10);
                $area_one = new \Measurement\Area($value,$unit);
                $area_two = $area_one->toUnit('sq_m');
                $this->assertTrue($area_one->isEqualTo($area_two), "{$area_one} is not equal to {$area_two}" );
            }
        }

    }
}