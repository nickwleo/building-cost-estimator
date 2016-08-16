<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    //

    protected $table = 'nodes';

    protected $fillable = [
        'title', 'price_per_meter', 'price_per_foot', 'node_id', 'blurb', 'subtypeString'
    ];

    public function nodes()
    {
        return $this->hasMany('App\Node');
    }

}
