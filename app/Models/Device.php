<?php

namespace App\Models;

use App\Models\Type;
use App\Models\Status;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Device extends Model
{
    use HasFactory;

    public $fillable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
        'type_id',
        'updated_at',
    ];

    protected $perPage = 10;

    public static $searchable = [
        'inventory_code',
        'identification_code',
        'model',
        'comment',
    ];

    public static $searchableRelationships = [
        'type',
        'status',
        'latestMovement',
        'latestHardware',
        'latestSoftware',
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('orderDevices', function (Builder $builder) {
            $builder->latest('updated_at')
                ->orderBy('inventory_code')
                ->orderBy('identification_code')
                ->orderBy('id');
        });
    }

    /**
     * Get the device hardware history.
     */
    public function hardware()
    {
        return $this->hasMany(Hardware::class);
    }

    /**
     * Get the device latest hardware.
     */
    public function latestHardware()
    {
        return $this->hasOne(Hardware::class)->ofMany([
            'date' => 'max',
            'id' => 'max',
        ]);
    }

    /**
     * Get the device latest movement.
     */
    public function latestMovement()
    {
        return $this->hasOne(Movement::class)->ofMany([
            'date' => 'max',
            'id' => 'max',
        ]);
    }

    /**
     * Get the device latest software.
     */
    public function latestSoftware()
    {
        return $this->hasOne(Software::class)->ofMany([
            'date' => 'max',
            'id' => 'max',
        ]);
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
     * Disable created_at.
     */
    public function setCreatedAt($value)
    {
      return null;
    }

    public function setInventoryCodeAttribute($value)
    {
        if ($value === '') {
            $value = null;
        }
        $this->attributes['inventory_code'] = $value;
    }

    public function setIdentificationCodeAttribute($value)
    {
        if ($value === '') {
            $value = null;
        }
        $this->attributes['identification_code'] = $value;
    }

    /**
     * Get the device software history.
     */
    public function software()
    {
        return $this->hasMany(Software::class);
    }

    /**
     * Get the device status.
     */
    public function status()
    {
        // A trick to make an one-to-one relationship with an intermediate table
        return $this->hasOneThrough(Status::class, Movement::class, 'device_id', 'id', 'id', 'status_id');
    }

    /**
     * Get the device type.
     */
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
    
    /**
     * Scope a query to only include resources that matched keywords.
     * 
     * Each keyword must be matched at least once
     * with any model field specified in class $serachable property.
     * 
     * If it is defined a $searchableRelationships property 
     * then each keyword must be matched with any model searchable field
     * or with any relationship searchable field. The relationship
     * searchable field list must be specified as its own $searchable property.
     * 
     * $deepSearch parameter enables search by $searchableRelationships list.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  array  $keywords
     * @param  bool $deepSearch
     * 
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function scopeSearch($query, Array $keywords, bool $deepSearch = true){

        foreach($keywords as $keyword){

            $query->where(function ($query) use ($keyword, $deepSearch) {

                foreach(static::$searchable as $column){
                    $query->orWhereRaw($column . '::text ilike ' . "'%$keyword%'");
                }

                if ($deepSearch) {
                    foreach(static::$searchableRelationships as $relationship){
                        $query->orWhereHas($relationship, function ($query) use ($keyword){
                            $query->search([$keyword], false);
                        });
                    }
                }
                
            });
        }
        
        return $query;
    }
}
