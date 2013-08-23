phpMeasures
===========

Measure classes to facilitate storing and converting units of measure.  Uses bcmath functions for arbitrary precision.

Installation
------------
You can clone the repo and use composer in your project or can just copy the files to your project directory and add in the relevant includes.

Usage
------------
You can create new Measure objects (Distance, Area, Volume, Weight and Data) to store measurement data.  Internally the objects store the data as both the given value and unit and the standard value and unit.  For example a Distance object that represents 1 inch would also internally store the value in metres (0.0254m).  You can then compare objects using the ```isEqualTo```, ```isGreaterThan``` and ```isLessThan``` methods.  You can also convert from one unit of measure with the ```toUnit``` method.  Comparison and conversion is always based off of the internal standard value.

```php
// Creating some Distance measurements
$length_one = new \Measurement\Distance('1','inch');
$length_two = new \Measurement\Distance('0.0254','m');
$length_three = \Measurement\Distance('0.1254','m');

// comparison
$is_equal = $length_one->isEqualTo($length_two); // true
$is_less = $length_one->isLessThan($length_three); // true
$is_more = $length_one->isGreaterThan($length_three); // false

// Don't compare different units of measure!
$area = new \Measurement\Area('1','sq_m');
$is_less = $area->isLessThan($length_two); // LogicException, cannot compare Distance and Area

// conversion
$metres = new \Measurement\Distance('1','m');
$yards = $meters->toUnit('yd');

// create a Weight measure from an array
$weight = \Measurement\Measure::fromArray(array(
    'measure_class' => '\Measurement\Weight',
    'value' => '1',
    'unit' => 'kg'
));

// or json
$another_weight = \Measurement\Measure::fromJson($a_valid_json_string);

// how about some bits and bytes ?
$data_one = new \Measurement\Data('1','KiB');  // 1 kilo-binary byte, 8192 bits
$data_two = new \Measurement\Data('1','KB');   // 1 kilobyte, SI standard, 8000 bits
$data_three = new \Measurement\Data('1','Mb'); // 1 megabit, 1000000 bits

```

You can also create your own Measure classes

```php
class MyMeasure extends \Measuremnet\Measure
{
    protected $no_rounding = false;
    protected $standard_unit = 'x';
    protected $standard_name = 'x unit';

    protected $units = array(
        'x' => '1.0',
        'kx' => '1000.0',
        'old_x' => '0.9'
    );

    protected $alias = array(
        'x unit' => 'x',
        'kilo-x' => 'kx',
        'Old x' => 'old_x',
    );
}
```

You've probably noticed that all the values being used are the string representations.  The Measure classes use the PHP bcmath functions to support arbitrary precision (default is 50), and those functions require strings.

TODO
------------
 - Add factory method to Area to create a new object from two Distance objects
 - Add factory methods to Volume to create a new object from three Distance objects or one Area and one Distance object
 - Add an Energy (Work) Measure class