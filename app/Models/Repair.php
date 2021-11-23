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

    public static $searchable = [
        'date',
        'cause',
        'result',
    ];
    
    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
   protected $touches = ['device'];

    /**
     * Get the movement device.
     */
    public function device(){
        return $this->belongsTo(Device::class);
    }

    public static function scopeSearch($query, Array $keywords){
        foreach($keywords as $keyword){

            $query->where(function ($query) use ($keyword) {

                foreach(static::$searchable as $column){
                    $query->orWhereRaw($column . '::text ilike ' . "'%$keyword%'");
                }
            });
        }
        
        return $query;
    }
}
