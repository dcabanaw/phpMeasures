<?php namespace Measurement;

class Data extends Measure {
    protected $no_rounding = true;
    protected $standard_unit = "b";
    protected $standard_name = "bit";
    protected $precision = 0;
    protected $units = array(
        # binary byte
        'KiB' => '8192',
        'MiB' => '8388608',
        'GiB' => '8589934592',
        'TiB' => '8796093022208',
        'PiB' => '9007199254740992',
        'EiB' => '9223372036854775808',
        # SI byte
        'kB' => '8000',
        'MB' => '8000000',
        'GB' => '8000000000',
        'TB' => '8000000000000',
        'PB' => '8000000000000000',
        'EB' => '8000000000000000000',
        # base
        'B' => '8',
        'b' => '1',
        'kb' => '1000',
        'Mb' => '1000000',
        'Gb' => '1000000000',
        'Tb' => '1000000000000',
        'Pb' => '1000000000000000',
        'Eb' => '1000000000000000000',
    );
    protected $alias = array(
        # binary bytes
        'kibibyte' => 'KiB',
        'mebibyte' => 'MiB',
        'gibibyte' => 'GiB',
        'tebibyte' => 'TiB',
        'pebibyte' => 'PiB',
        'exbibyte' => 'EiB',
        #SI bytes
        'kilobyte' => 'kB',
        'megabyte' => 'MB',
        'gigabyte' => 'GB',
        'terabyte' => 'TB',
        'petabyte' => 'PB',
        'exabyte' =>  'EB',
        # base
        'byte' =>     'B',
        'bit' =>      'b',
        'kilobit' =>  'kb',
        'megabit' =>  'Mb',
        'gigabit' =>  'Gb',
        'terabit' =>  'Tb',
        'petabit' =>  'Pb',
        'exabit' =>   'Eb',
    );
}