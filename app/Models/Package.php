<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'duration',
        'status',
        'included_services',
        'excluded_services',
    ];

    protected $casts = [
        'included_services' => 'array',
        'excluded_services' => 'array',
        'status' => 'boolean',
    ];
}
