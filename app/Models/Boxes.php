<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Boxes extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function collections(){
        return $this->hasMany(Collections::class);
    }
}
