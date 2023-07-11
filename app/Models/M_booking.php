<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_booking extends Model
{
    use HasFactory;
    protected $table ='bookings';
    protected $fillable = ['date_booking','coderandom','user_id','jenis','image','status'];
    public function users () {
        return $this->belongsTo(User::class,'user_id', 'id');
    }
}
