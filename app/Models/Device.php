<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static $searchable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
    ];

    public static $searchableRelationships = [
        'type',
        'status',
        'last_movement',
        'last_hardware',
        'last_software',
    ];

    protected $perPage = 10;

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
     * Get the device last movement entry.
     */
    public function last_movement()
    {
        return $this->hasOne(Movement::class);
    }

    /**
     * Get the device repairs.
     */
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }

    /**
     * Get the device last hardware entry.
     */
    public function last_hardware()
    {
        return $this->hasOne(Hardware::class);
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

    /**
     * Get the device last software entry.
     */
    public function last_software()
    {
        return $this->hasOne(Software::class);
    }
    
    /**
     * Scope a query to only include devices that matched keywords.
     * 
     * Each keyword must be matched at least once
     * with any model field specified in class $serachable property.
     * 
     * Additional it is able to specified relationsip names array as
     * model $searchableRelationships property.
     * Then Each keyword must be matched with any model searchable field
     * or with any relationship searchable field. The relationship
     * searchable field list must be specified as its own $searchable property.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $keywords
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeSearch($query, Array $keywords){

        foreach($keywords as $keyword){

            $query->where(function ($query) use ($keyword) {

                foreach(static::$searchable as $column){
                    $query->orWhereRaw($column . '::text ilike ' . "'%$keyword%'");
                }

                foreach(static::$searchableRelationships as $relationship){
                    $query->orWhereHas($relationship, function ($query) use ($keyword){
                        $query->search([$keyword]);
                    });
                }
                
            });
        }
        
        return $query;
    }
}
