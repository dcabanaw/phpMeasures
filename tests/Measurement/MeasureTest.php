<?php
class MeasureTest extends PHPUnit_Framework_TestCase {

    public function testCreateObjectsFromArray()
    {
        $distance = \Measurement\Measure::fromArray(array(
            'measure_class' => '\Measurement\Distance',
            'value' => '1',
            'unit' => 'm'
        ));
        $this->assertInstanceOf('\Measurement\Distance', $distance);
        $this->assertInstanceOf('\Measurement\Measure', $distance);

        $area = \Measurement\Measure::fromArray(array(
            'measure_class' => '\Measurement\Area',
            'value' => '1',
            'unit' => 'sq_m'
        ));
        $this->assertInstanceOf('\Measurement\Area', $area);
        $this->assertInstanceOf('\Measurement\Measure', $area);

        $volume = \Measurement\Measure::fromArray(array(
            'measure_class' => '\Measurement\Volume',
            'value' => '1',
            'unit' => 'cubic_meter'
        ));
        $this->assertInstanceOf('\Measurement\Volume', $volume);
        $this->assertInstanceOf('\Measurement\Measure', $volume);

        $weight = \Measurement\Measure::fromArray(array(
            'measure_class' => '\Measurement\Weight',
            'value' => '1',
            'unit' => 'kg'
        ));
        $this->assertInstanceOf('\Measurement\Weight', $weight);
        $this->assertInstanceOf('\Measurement\Measure', $weight);
    }

    public function testCreateObjectsFromJson()
    {
        $distance = \Measurement\Measure::fromJson(json_encode(array(
            'measure_class' => '\Measurement\Distance',
            'value' => '1',
            'unit' => 'm'
        )));
        $this->assertInstanceOf('\Measurement\Distance', $distance);
        $this->assertInstanceOf('\Measurement\Measure', $distance);

        $area = \Measurement\Measure::fromJson(json_encode(array(
            'measure_class' => '\Measurement\Area',
            'value' => '1',
            'unit' => 'sq_m'
        )));
        $this->assertInstanceOf('\Measurement\Area', $area);
        $this->assertInstanceOf('\Measurement\Measure', $area);

        $volume = \Measurement\Measure::fromJson(json_encode(array(
            'measure_class' => '\Measurement\Volume',
            'value' => '1',
            'unit' => 'cubic_meter'
        )));
        $this->assertInstanceOf('\Measurement\Volume', $volume);
        $this->assertInstanceOf('\Measurement\Measure', $volume);

        $weight = \Measurement\Measure::fromJson(json_encode(array(
            'measure_class' => '\Measurement\Weight',
            'value' => '1',
            'unit' => 'kg'
        )));
        $this->assertInstanceOf('\Measurement\Weight', $weight);
        $this->assertInstanceOf('\Measurement\Measure', $weight);
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationInvalidArray()
    {
        $distance = \Measurement\Measure::fromArray(array(
            'measuree_class' => '\Measurement\Distance',
            'value' => '2',
            'aunit' => 'm'
        ));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationInvalidJsonData()
    {
        $distance = \Measurement\Measure::fromJson(json_encode(array(
            'measuree_class' => '\Measurement\Distance',
            'value' => '2',
            'aunit' => 'm'
        )));
    }

    /**
     * @expectedException \UnexpectedValueException
     */
    public function testObjectCreationInvalidJsonString()
    {
        $bad_json = '{{"measuree_class": "\\Measurement\\Distance", "value": "2", "aunit": "m"};';
        $distance = \Measurement\Measure::fromJson($bad_json);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testObjectCreationInvalidClassName()
    {
        $distance = \Measurement\Measure::fromArray(array(
            'measure_class' => '\Measurement\Distances',
            'value' => '1',
            'unit' => 'm'
        ));
    }
}