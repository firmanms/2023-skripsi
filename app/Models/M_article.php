<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_article extends Model
{
    use HasFactory;
    protected $table ='articles';
    protected $fillable = ['judul','slug','description','status','category_id','image','publish'];
}
