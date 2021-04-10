<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trade extends Model
{
    public $timestamps = false;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function broker()
    {
        return $this->belongsTo(Broker::class);
    }
}
