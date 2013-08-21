<?php namespace Measurement;

abstract class Measure {

    protected $precision = 50; // default precision
    protected $measure_value = "";
    protected $measure_unit = "";
    protected $measure_name = "";
    protected $standard_value = "";

    public function __construct($value, $unit)
    {
        if(! array_key_exists($unit, $this->units))
            throw new \UnexpectedValueException("Unkown unit: {$unit}", 1);

        if (! isset($this->standard_unit))
            throw new \RuntimeException( get_class($this) . ' must have property $standard_unit', 1);

        if (! isset($this->standard_name))
            throw new \RuntimeException( get_class($this) . ' must have property $standard_name', 1);

        $this->measure_value = $value;
        $this->measure_unit = $unit;
        $this->measure_name = $this->getUnitName($this->measure_unit);
        $this->convertToStandard();
    }


    /**
     * method to round string numbers intended to be used with the bc math functions
     * Thanks to Alix Axel (http://stackoverflow.com/questions/1642614/how-to-ceil-floor-and-round-bcmath-numbers)
     * @param string $number the number to be rounded
     *
     */
    protected function bcround($number)
    {
        if ($this->no_rounding)
            return $number;

        $precision = $this->precision-1;
        if (strpos($number, '.') !== false)
        {
            if ($number[0] != '-')
                return bcadd($number, '0.' . str_repeat('0', $precision) . '5', $precision) ;

            return bcsub($number, '0.' . str_repeat('0', $precision) . '5', $precision);
        }

        return $number;
    }


    /**
     * convert the object's given unit to the standard unit
     */
    protected function convertToStandard()
    {
        $value = $this->measure_value;
        $factor = $this->getFactor($this->measure_unit);
        $this->standard_value = $this->bcround(bcmul($value, $factor, $this->precision));
    }


    /**
     * return an new object with the specified unit
     * @param string $unit  the unit to convert to
     * @return Measure
     */
    public function toUnit($unit)
    {
        $klass = get_class($this);
        $factor = $this->getFactor($unit);
        $value = $this->standard_value;
        $new_value = $this->bcround(bcdiv($value, $factor, $this->precision));
        return new $klass($new_value, $unit);
    }


    /**
     * Set the scale for BC math functions, and re-calculate the standard unit
     * @param integer $scale the scle to set
     * @return self
     */
    public function setPrecision($scale)
    {
        $this->$precision = $scale;
        $this->calculate();
        return $this;
    }


    /**
     * Get the scale for BC math functions
     * @return integer
     */
    public function getPrecision()
    {
        return $this->precision;
    }


    /**
     * Get the conversion factor for a specified unit
     * @param string $unit the unit factor to get
     * @return string
     * @throws UnexpectedValueException
     */
    public function getFactor($unit)
    {
        if(array_key_exists($unit, $this->units))
            return $this->units[$unit];
        throw new \UnexpectedValueException("Unkown unit: {$unit}", 1);
    }


    /**
     * Get the alias of a unit by it's name
     * @param string $name the name of the unit ('centimetres' for example would return 'cm')
     * @return string
     * @throws UnexpectedValueException
     */
    public function getUnitAlias($name)
    {
        if(array_key_exists($name, $this->ailias))
            return $this->ailias[$name];
        throw new \UnexpectedValueException("Unkown unit name: {$name}", 1);
    }


    /**
     * Get the name of a unit by it's alias
     * @param string $alias the name of the unit ('centimetres' for example would return 'cm')
     * @return string
     * @throws UnexpectedValueException
     */
    public function getUnitName($alias)
    {
        $key = array_search($alias, $this->alias);
        if($key !== false && array_key_exists($key, $this->alias))
            return $key;
        return $alias;
        //throw new \UnexpectedValueException("Unkown unit alias: {$alias}", 1);
    }


    /**
     * Get all aliases of this Measure
     * @return array
     */
    public function getAllAliases()
    {
        return $this->alias;
    }


    /**
     * Get all factors of this Measure
     * @return array
     */
    public function getAllFactors()
    {
        return $this->units;
    }


    /**
     * check to set if the two objects are of the same measure
     */
    protected function isSameMeasure(Measure $other)
    {
        if($this->getStandardUnit() !== $other->getStandardUnit())
            throw new \LogicException("Cannot compare different measures! Tried comparing {$this->getStandardUnit()} with {$other->getStandardUnit()})",1);
    }

    /**
     * Check to see if one measure is equal to another
     * @param Measure $other  The other measure to compare
     * @return bool
     */
    public function isEqualTo(Measure $other)
    {
        $this->isSameMeasure($other);
        if( bccomp($this->standard_value, $other->getStandardValue(), $this->precision) === 0)
            return true;
        return false;
    }


    /**
     * Check to see if one measure is greater than another
     * @param Measure $other  The other measure to compare
     * @return bool
     */
    public function isGreaterThan(Measure $other)
    {
        $this->isSameMeasure($other);
        if( bccomp($this->standard_value, $other->getStandardValue(), $this->precision) === 1)
            return true;
        return false;
    }


    /**
     * Check to see if one measure is less than another
     * @param Measure $other  The other measure to compare
     * @return bool
     */
    public function isLessThan(Measure $other)
    {
        $this->isSameMeasure($other);
        if( bccomp($this->standard_value, $other->getStandardValue(), $this->precision) === -1)
            return true;
        return false;
    }


    /**
     * return array of data of this object
     * @return array
     */
    public function toArray()
    {
        return array(
            'measure_class' => get_class($this),
            'value' => $this->measure_value,
            'unit' => $this->measure_unit,
            'name' => $this->measure_name,
            'standard_value' => $this->standard_value,
            'standard_unit' => $this->standard_unit,
            'standard_name' => $this->standard_name
        );
    }


    /**
     * return json string data of this object
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }


    /**
     * create an Measure object from an array
     * @param array $data an array that contains the key/values for measure_class, value and unit
     * @return Measure
     */
    public static function fromArray($data)
    {
        if(array_key_exists('measure_class', $data) && array_key_exists('value', $data) && array_key_exists('unit', $data))
            if(class_exists($data['measure_class'])){
                return new $data['measure_class']($data['value'],$data['unit']);
            } else {
                throw new \InvalidArgumentException("The '{$data['measure_class']}'' class does not exist",1);
            }
        throw new \UnexpectedValueException('A required key is missing or invalid',1);
    }


    /**
     * create an Measure object from json data
     * @param string $str a JSON string that contains the key/values for measure_class, value and unit
     * @return Measure
     */
    public static function fromJson($str)
    {
        $data = json_decode($str, true);
        if($data === null)
            throw new \UnexpectedValueException('JSON string is malformed',1);
        return static::fromArray($data);
    }


    /**
     * __toString method
     */
    public function __toString()
    {
        return $this->standard_value . " " . $this->standard_unit;
    }

    /*
     * Getters
     */

    public function getMeasureValue()
    {
        return $this->measure_value;
    }

    public function getMeasureUnit()
    {
        return $this->measure_unit;
    }

    public function getMeasureName()
    {
        return $this->measure_name;
    }

    public function getStandardValue()
    {
        return $this->standard_value;
    }

    public function getStandardUnit()
    {
        return $this->standard_unit;
    }

    public function getStandardName()
    {
        return $this->standard_name;
    }
}
