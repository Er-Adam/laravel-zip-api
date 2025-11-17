<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostalCode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["postal_code", "city_id"];

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}
