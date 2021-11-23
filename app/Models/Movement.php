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
        'status_id',
    ];

    public static $searchable = [
        'date',
        'location',
        'comment',
    ];

    public $timestamps = false;
    
    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
   protected $touches = ['device'];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('orderMovement', function (Builder $builder) {
            $builder->latest('date')->orderByDesc('id');
        });
    }

    /**
     * Get the movement device.
     */
    public function device(){
        return $this->belongsTo(Device::class);
    }

    /**
     * Get the device status.
     */
    public function status(){
        return $this->belongsTo(Status::class);
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
