<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    public $fillable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
        'type_id',
        'status_id',
    ];

    public $searchable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
    ];

    /**
     * Get the device status.
     */
    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the device type.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    /**
     * Get the device movements.
     */
    public function movements()
    {
        return $this->hasMany(Movement::class);
    }

    /**
     * Get the device repairs.
     */
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    /**
     * Get the device hardware history.
     */
    public function hardware()
    {
        return $this->hasMany(Hardware::class);
    }

    /**
     * Get the device software history.
     */
    public function software()
    {
        return $this->hasMany(Software::class);
    }
}
