<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama', 'status'
    ];
    public function article()
    {
        return $this->hasMany('App\Models\M_article','category_id');
    }

}
