<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('software', function (Builder $builder) {
            $builder->latest('date')->orderByDesc('id');
        });
    }
}
