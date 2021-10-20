<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hardware extends Model
{
    use HasFactory;

    /**
     * Check if the the motherboard replacement was.
     */
    public function motherboard_replacement_flag()
    {
        return $this->hasOne(MotherboardReplacementLog::class, 'hardware_id');
    }
}
