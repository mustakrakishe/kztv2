<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Software extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'description',
        'comment',
        'device_id',
    ];

    public $searchable = [
        'date',
        'description',
        'comment',
    ];
}
