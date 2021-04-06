<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function trades()
    {
        return $this->hasMany(Trade::class);
    }
}
