<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Software extends Model
{
    use HasFactory;

    public $fillable = [
        'date',
        'description',
        'comment',
        'device_id',
    ];

    public static $searchable = [
        'date',
        'description',
        'comment',
    ];

    public $timestamps = false;
    
    /**
    * All of the relationships to be touched.
    *
    * @var array
    */
   protected $touches = ['device'];

   public function __construct(array $attributes = [])
   {
       $this->setRawAttributes([
           'date' => Carbon::now(),
       ], true);
       
       parent::__construct($attributes);
   }

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
    
    /**
     * Prepare a date for array / JSON serialization to 'Y-m-dTH:i:s' format.
     *
     * @return string
     */
    protected function getDateAttribute()
    {
        return str_replace(' ', 'T', $this->attributes['date']);
    }
}
