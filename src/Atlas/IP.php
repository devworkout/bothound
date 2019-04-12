<?php


namespace DevWorkout\Bothound\Atlas;


class IP
{
    protected $octets = [];

    /**
     * IP constructor.
     * @param $ip
     */
    public function __construct( $ip )
    {
        $this->octets = collect( explode( '.', $ip ) );
    }

    public function subnet()
    {
        return new Range( $this->octets->take( 3 ) );
    }

}