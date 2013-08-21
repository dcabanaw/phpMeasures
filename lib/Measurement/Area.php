<?php namespace Measurement;

class Area extends Measure {

    protected $no_rounding = false;
    protected $standard_unit = "sq_m";
    protected $standard_name = "square metre";
    protected $units = array();
    protected $alias = array();

    /**
     * Overide the Measure constructor so we can populate
     * $units and $alias based off of \Measurement\Distance
     * by prefixing units with 'sq_' and squaring
     * the unit factors
     */
    public function __construct($value, $unit)
    {
        $d = new \Measurement\Distance('1','m');
        $units = $d->getAllFactors();
        $aliases = $d->getAllAliases();

        // create units array based of distance units
        foreach ($units as $u => $f) {
            $this->units['sq_' . $u] = bcpow($f, '2', $this->precision);
        }

        // create alias array based of distance alias
        foreach ($aliases as $name => $alias) {
            $this->alias[$name] = 'sq_' . $alias;
        }

        parent::__construct($value, $unit);
    }
}