<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $table = 'devices';

    protected $fillable = [
        'serial_number',
        'topik',
        'status',
        'last_seen',
    ];
}