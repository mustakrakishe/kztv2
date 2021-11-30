<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static $searchableRelationships = [
        'status',
        'device',
    ];

    public $timestamps = false;

    public function __construct(array $attributes = [])
    {
        $IN_STORAGE_STATUS_ID = 2;

        $this->setRawAttributes([
            'location' => 'ЗУ. АСУ. 210',
            'comment' => 'Новий',
            'status_id' => $IN_STORAGE_STATUS_ID,
            'date' => Carbon::now(),
        ], true);
        
        parent::__construct($attributes);
    }
    
    /**
     * Prepare a date for array / JSON serialization to 'Y-m-dTH:i:s' format.
     *
     * @return string
     */
    protected function getDateAttribute()
    {
        return str_replace(' ', 'T', $this->attributes['date']);
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
