<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'name',
        'role',
        'password'
        
    ];

    public function managers(){
        return $this->hasMany(manager::class);
    }

    public function dispatchers(){
        return $this->hasMany(dispatcher::class);
    }
}
