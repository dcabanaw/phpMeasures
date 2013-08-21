<?php
class DataMeasureTest extends PHPUnit_Framework_TestCase {

    public function testObjectCreation()
    {
        $data = new \Measurement\Data('1','b');
        $this->assertInstanceOf('\Measurement\Data',$data);
        $this->assertInstanceOf('\Measurement\Measure',$data);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationWithUnknownUnit()
    {
        $data = new \Measurement\Data('1','aaaaa');
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testUnkownUnit()
    {
        $data = new \Measurement\Data('1','aaaaaa');
        $data->getFactor('metress');
    }

    public function testIsEqualTo()
    {
        $data_one = new \Measurement\Data('1','B');
        $data_two = new \Measurement\Data('8','b');
        $this->assertTrue($data_one->isEqualTo($data_two), "{$data_one} is not equal to {$data_two}" );

        $data_one = new \Measurement\Data('1','B');
        $data_two = new \Measurement\Data('9','b');
        $this->assertFalse($data_one->isEqualTo($data_two), "{$data_one} is equal to {$data_two}" );
    }

    public function testIsLessThan()
    {
        $data_one = new \Measurement\Data('1','B');
        $data_two = new \Measurement\Data('2','B');
        $this->assertTrue($data_one->isLessThan($data_two), "{$data_one} is not less than {$data_two}");

        $data_one = new \Measurement\Data('1','B');
        $data_two = new \Measurement\Data('2','B');
        $this->assertFalse($data_two->isLessThan($data_one), "{$data_one} is less than {$data_two}");
    }

    public function testIsGreaterThan()
    {
        $data_one = new \Measurement\Data('2','B');
        $data_two = new \Measurement\Data('1','B');
        $this->assertTrue($data_one->isGreaterThan($data_two), "{$data_one} is not greater than {$data_two}");

        $data_one = new \Measurement\Data('2','B');
        $data_two = new \Measurement\Data('1','B');
        $this->assertFalse($data_two->isGreaterThan($data_one), "{$data_one} is greater than {$data_two}");
    }

    public function testToUnit()
    {
        $data = new \Measurement\Data('1','b');
        $factors = $data->getAllFactors();
        foreach ($factors as $unit => $factor) {
            for ($i=0; $i < 1001; $i++) {
                $value = (string)($i/10);
                $data_one = new \Measurement\Data($value,$unit);
                $data_two = $data_one->toUnit('b');
                $this->assertTrue($data_one->isEqualTo($data_two), "{$data_one} is not equal to {$data_two}" );
            }
        }

    }
}