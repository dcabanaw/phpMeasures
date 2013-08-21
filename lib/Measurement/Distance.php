<?php namespace Measurement;

class Distance extends Measure {
    protected $no_rounding = false;
    protected $standard_unit = "m";
    protected $standard_name = "metre";
    protected $units = array(
        'chain' => '20.1168',
        'chain_benoit' => '20.116782',
        'chain_sears' => '20.1167645',
        'british_chain_benoit' => '20.1167824944',
        'british_chain_sears' => '20.1167651216',
        'british_chain_sears_truncated' => '20.116756',
        'cm' => '0.01',
        'british_ft' => '0.304799471539',
        'british_yd' => '0.914398414616',
        'clarke_ft' => '0.3047972654',
        'clarke_link' => '0.201166195164',
        'fathom' =>  '1.8288',
        'ft'=> '0.3048',
        'german_m' => '1.0000135965',
        'gold_coast_ft' => '0.304799710181508',
        'indian_yd' => '0.914398530744',
        'inch' => '0.0254',
        'km'=> '1000.0',
        'link' => '0.201168',
        'link_benoit' => '0.20116782',
        'link_sears' => '0.20116765',
        'm'=> '1.0',
        'mi'=> '1609.344',
        'mm' => '0.001',
        'nmi'=> '1852.0',
        'nmi_uk' => '1853.184',
        'rod' => '5.0292',
        'sears_yd' => '0.91439841',
        'survey_ft' => '0.304800609601',
        'um' => '0.000001',
        'nm' => '0.000000001',
        'yd'=> '0.9144',
    );
    protected $alias = array(
        'metre' => 'm',
        'meter' => 'm',
        'nanometre' => 'nm',
        'nanometer' => 'nm',
        'micrometre' => 'um',
        'micrometer' => 'um',
        'millimetre' => 'mm',
        'millimeter' => 'mm',
        'centimetre' => 'cm',
        'centimeter' => 'cm',
        'kilometre' => 'km',
        'kilometer' => 'km',
        'foot' => 'ft',
        'inches' => 'inch',
        'mile' => 'mi',
        'yard' => 'yd',
        'British chain (Benoit 1895 B)' => 'british_chain_benoit',
        'British chain (Sears 1922)' => 'british_chain_sears',
        'British chain (Sears 1922 truncated)' => 'british_chain_sears_truncated',
        'British foot (Sears 1922)' => 'british_ft',
        'British foot' => 'british_ft',
        'British yard (Sears 1922)' => 'british_yd',
        'British yard' => 'british_yd',
        "Clarke's Foot" => 'clarke_ft',
        "Clarke's link" => 'clarke_link',
        'Chain (Benoit)' => 'chain_benoit',
        'Chain (Sears)' => 'chain_sears',
        'Foot (International)' => 'ft',
        'German legal metre' => 'german_m',
        'Gold Coast foot' => 'gold_coast_ft',
        'Indian yard' => 'indian_yd',
        'Link (Benoit)'=> 'link_benoit',
        'Link (Sears)'=> 'link_sears',
        'Nautical Mile' => 'nmi',
        'Nautical Mile (UK)' => 'nmi_uk',
        'US survey foot' => 'survey_ft',
        'U.S. Foot' => 'survey_ft',
        'Yard (Indian)' => 'indian_yd',
        'Yard (Sears)' => 'sears_yd'
    );
}