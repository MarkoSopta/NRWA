<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;


class User extends Authenticatable

{
    use HasFactory, Notifiable, HasApiTokens;
    public $timestamps = true;
    
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
