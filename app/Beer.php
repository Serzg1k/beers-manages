<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Beer extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'make_id',
        'type_id',
    ];

    /**
     * The make, that this message is associated with.
     */
    public function make(): BelongsTo
    {
        return $this->belongsTo(Make::class);
    }

    /**
     * The make, that this message is associated with.
     */
    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }
}
