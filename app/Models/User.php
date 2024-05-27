<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable

{
    use Notifiable;
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'name',
        'role',
        'password',
        'email'
        
    ];

    public function managers(){
        return $this->hasMany(manager::class);
    }

    public function dispatchers(){
        return $this->hasMany(dispatcher::class);
    }
}
