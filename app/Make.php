<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Make extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function types()
    {
        return $this->belongsToMany(Type::class, 'beers', 'make_id', 'type_id');
    }

    public function scopeHasTypes(Builder $query, $typeId){
        return $query->whereHas('types', function ($q) use ($typeId) {
            return $q->where('type_id', '=', $typeId);
        });
    }
}
