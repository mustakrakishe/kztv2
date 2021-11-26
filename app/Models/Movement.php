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
        'status'
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
