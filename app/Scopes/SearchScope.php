<?php

namespace App\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SearchScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  Array  $keywords
     * @return void
     */
    public function apply(Builder $builder, Model $model, Array $keywords = [])
    {
        foreach($keywords as $keyword){

            $builder->where(function ($query) use ($model, $keyword) {

                foreach($model->searchable as $column){
                    $query->orWhereRaw($column . '::text like ' . "'%$keyword%'");
                }

            });

        }
    }
}