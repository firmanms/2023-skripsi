<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_like extends Model
{
    use HasFactory;
    protected $table ='likes';
    protected $fillable = ['artikel_id','user_id','like','dislike'];
    public function posts () {
        return $this->hasMany(M_article::class,'artikel_id','id');
    }

}
