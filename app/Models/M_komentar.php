<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_komentar extends Model
{
    use HasFactory;
    protected $table ='komentars';
    protected $fillable = ['artikel_id','parent_id','user_id','komentar'];
    public function users () {
        return $this->belongsTo(User::class,'user_id', 'id');
    }

    public function posts () {
        return $this->belongsTo(M_article::class,'artikel_id','id');
    }

    public function child()
    {
        return $this->hasMany(M_komentar::class, 'parent_id');
    }
}
