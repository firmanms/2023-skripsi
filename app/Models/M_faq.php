<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_faq extends Model
{
    use HasFactory;
    protected $table ='faqs';
    protected $fillable = ['parent_id','value'];
    public function child()
    {
        return $this->hasMany(M_faq::class, 'parent_id');
    }
}
