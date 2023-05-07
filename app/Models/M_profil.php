<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_profil extends Model
{
    use HasFactory;
    protected $table ='configs';
    protected $fillable = ['nama_kepala','sambutan','selayang_pandang','tupoksi','video_profil','foto_kepala',
                           'nama_kantor','alamat_kantor','url_map','telp_kantor','hotline_wa','email_kantor','jam_layanan',
                           'seo_desc','seo_keywords',
                           'fb','ig','tw','channel_yt',
                           'logo','favicon'];
}
