<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["name","county_id"];

    public function county(){
        return $this->belongsTo(County::class);
    }

    public function postalCodes(){
        return $this->hasMany(PostalCode::class);
    }
}
