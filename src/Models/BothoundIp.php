<?php

namespace DevWorkout\Bothound\Models;

use Illuminate\Database\Eloquent\Model;

class BothoundIp extends Model
{
    protected $guarded = [];

    public function subnet()
    {
        return app( 'bothound' )->ip( $this->ip )->subnet()->prefix();
    }
}
