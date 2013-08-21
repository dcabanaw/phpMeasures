<?php
class VolumeMeasureTest extends PHPUnit_Framework_TestCase {

    public function testObjectCreation()
    {
        $volume = new \Measurement\Volume('1','cubic_meter');
        $this->assertInstanceOf('\Measurement\Volume',$volume);
        $this->assertInstanceOf('\Measurement\Measure',$volume);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationWithUnknownUnit()
    {
        $volume = new \Measurement\Volume('1','aaaaa');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnkownUnit()
    {
        $volume = new \Measurement\Volume('1','aaaaaa');
        $volume->getFactor('metress');
    }

    public function testIsEqualTo()
    {
        $volume_one = new \Measurement\Volume('1','cubic_foot');
        $volume_two = new \Measurement\Volume('0.0283168','cubic_meter');
        $this->assertTrue($volume_one->isEqualTo($volume_two), "{$volume_one} is not equal to {$volume_two}" );

        $volume_one = new \Measurement\Volume('1','cubic_foot');
        $volume_two = new \Measurement\Volume('0.0283168000000001','cubic_meter');
        $this->assertFalse($volume_one->isEqualTo($volume_two), "{$volume_one} is equal to {$volume_two}" );
    }

    public function testIsLessThan()
    {
        $volume_one = new \Measurement\Volume('1','cubic_foot');
        $volume_two = new \Measurement\Volume('1.5','cubic_foot');
        $this->assertTrue($volume_one->isLessThan($volume_two), "{$volume_one} is not less than {$volume_two}");

        $volume_one = new \Measurement\Volume('1','cubic_foot');
        $volume_two = new \Measurement\Volume('1.5','cubic_foot');
        $this->assertFalse($volume_two->isLessThan($volume_one), "{$volume_one} is less than {$volume_two}");
    }

    public function testIsGreaterThan()
    {
        $volume_one = new \Measurement\Volume('1.5','cubic_foot');
        $volume_two = new \Measurement\Volume('1','cubic_foot');
        $this->assertTrue($volume_one->isGreaterThan($volume_two), "{$volume_one} is not greater than {$volume_two}");

        $volume_one = new \Measurement\Volume('1.5','cubic_foot');
        $volume_two = new \Measurement\Volume('1','cubic_foot');
        $this->assertFalse($volume_two->isGreaterThan($volume_one), "{$volume_one} is greater than {$volume_two}");
    }

    public function testToUnit()
    {
        $volume = new \Measurement\Volume('1','cubic_meter');
        $factors = $volume->getAllFactors();
        foreach ($factors as $unit => $factor) {
            for ($i=0; $i < 1001; $i++) {
                $value = (string)($i/10);
                $volume_one = new \Measurement\Volume($value,$unit);
                $volume_two = $volume_one->toUnit('cubic_meter');
                $this->assertTrue($volume_one->isEqualTo($volume_two), "{$volume_one} is not equal to {$volume_two}" );
            }
        }

    }
}