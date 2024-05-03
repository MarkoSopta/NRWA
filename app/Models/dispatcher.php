<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dispatcher extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $fillable = [
        'name',
        'phone'
        
    ];
    public function users(){
        return $this->belongsTo(users::class);
    }

}
