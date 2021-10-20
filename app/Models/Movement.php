<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('movement', function (Builder $builder) {
            $builder->latest('date')->orderByDesc('id');
        });
    }
}
