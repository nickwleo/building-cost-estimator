<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calculation extends Model
{
    //

    protected $table = 'calculations';

    protected $fillable = [
        'area', 'units', 'estimate'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}

