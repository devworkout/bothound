<?php

namespace DevWorkout\Bothound\Atlas;

class Range
{
    protected $octets = [];

    public function __construct( $octets )
    {
        $this->octets = collect( $octets );
    }

    public function prefix()
    {
        return $this->octets->implode( '.' );
    }

    public function mask()
    {
        return $this->prefix() . '.*';
    }

    public function ips()
    {
        $return = [];
        for ( $i = 1; $i < 255; $i++ )
        {
            $return [] = $this->prefix() . '.' . $i;
        }
        return $return;
    }

}