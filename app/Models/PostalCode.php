<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostalCode extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ["postal_code","city_id"];

    public function city(){
        return $this->belongsTo(City::class);
    }
}
