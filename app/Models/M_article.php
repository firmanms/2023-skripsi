<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_article extends Model
{
    use HasFactory;
    protected $table ='articles';
    protected $fillable = ['user_id','judul','slug','description','status','category_id','image','publish'];

    public function users () {
        return $this->belongsTo(User::class,'user_id', 'id');
      }

    public function category()
    {
        return $this->belongsTo('App\Models\Kategori','category_id');
    }
    public function like()
    {
        return $this->hasMany(M_like::class,'artikel_id','id');
    }
    public function komentars()
    {
        return $this->hasMany(M_komentar::class,'artikel_id')->whereNull('parent_id');
    }

    public function komentarnya () {
        return $this->hasMany(M_komentar::class,'user_id','user_id');
    }
    public function komentarnya2 () {
        return $this->hasMany(M_komentar::class,'artikel_id','id');
    }

}

