<?php namespace Measurement;

class Volume extends Measure {
    protected $no_rounding = false;
    protected $standard_unit = 'cubic_meter';
    protected $standard_name = 'cubic meter';
    protected $units = array(
        'us_g'              => '0.00378541',
        'us_qt'             => '0.000946353',
        'us_pint'           => '0.000473176',
        'us_cup'            => '0.000236588',
        'us_oz'             => '0.0000295735295625', //'us_oz'=> 2.9574e-5,
        'cubic_centimeter'  => '100.0',
        'cubic_meter'       => '1.0',
        'l'                 => '0.001',
        'ml'                => '0.000001',
        'cubic_foot'        => '0.0283168',
        'cubic_inch'        => '0.00001639',
        'imperial_g'        => '0.00454609',
        'imperial_qt'       => '0.00113652',
        'imperial_pint'     => '0.000568261',
        'imperial_oz'       => '0.0000284130625', //'imperial_oz' => '2.8413e-5',
    );
    protected $alias = array(
        'US Gallon'=> 'us_g',
        'US Quart'=> 'us_qt',
        'US Pint'=> 'us_pint',
        'US Cup'=> 'us_cup',
        'US Ounce'=> 'us_oz',
        'US Fluid Ounce'=> 'us_oz',
        'cubic centimeter'=> 'cubic_centimeter',
        'cubic meter'=> 'cubic_meter',
        'liter'=> 'l',
        'milliliter'=> 'ml',
        'cubic foot'=> 'cubic_foot',
        'cubic inch'=> 'cubic_inch',
        'Imperial Gram'=> 'imperial_g',
        'Imperial Quart'=> 'imperial_qt',
        'Imperial Pint'=> 'imperial_pint',
        'Imperial Ounce'=> 'imperial_oz',
    );
}