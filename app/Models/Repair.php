<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'cause',
        'result',
        'device_id',
    ];

    public $searchable = [
        'date',
        'cause',
        'result',
    ];
}
