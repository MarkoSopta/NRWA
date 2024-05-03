<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    public $timestamps = true;
    use HasFactory;
protected $fillable = [
    'name',
    'location_id'
];
    public function users(){
        return $this->belongsTo(users::class);
    }

}
