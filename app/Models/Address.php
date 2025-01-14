<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Address extends Model
{
    protected $fillable = [
        'country',
        'city',
        'postcode',
        'street',
        'building',
        'flat'
    ];

    public function addressable(): MorphTo
    {
        return $this->morphTo();
    }
}
