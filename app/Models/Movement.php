<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'location',
        'comment',
        'device_id',
    ];

    public $searchable = [
        'date',
        'location',
        'comment',
    ];
}
