<?php

namespace App\Http\Controllers;

// use App\Models\Api;
use App\Models\M_banner;
// use App\Models\M_agenda;
// use App\Models\M_pegawai;
// use App\Models\M_layanan;
// use App\Models\M_linkterkait;
use App\Models\M_profil;
// use App\Models\M_page;
// use App\Models\M_link;
// use App\Models\M_link_sub;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        //profil
        $profils=  M_profil::first();
        //banner
        $banners=  M_banner::first();
        // //agenda
        // $agendas=  M_agenda::get();
        // //layanan
        // $layanans=  M_layanan::get();
        // //Pegawai
        // $pegawais=  M_pegawai::get();
        // //Link
        // $links=  M_link::all()->load('link_sub');
        // //apipemkab
        // $databasenyapemkab= Api::first();
        // $jsonurlpemkab = "$databasenyapemkab->urlnya";
        // $jsonpemkab = file_get_contents($jsonurlpemkab);
        // $ambilpemkab = json_decode($jsonpemkab,true);
        // //apipemkabberdasarkan
        // // $databasenyacustom= Api::where('id','2')->first();
        // // $jsonurlcustom = "$databasenyacustom->urlnya";
        // // $jsoncustom = file_get_contents($jsonurlcustom);
        // // $ambilcustom = json_decode($jsoncustom,true);
        // //urlantriansimpus
        // $urlantrian= Api::where('id','4')->first();
        // $urlantriannya=$urlantrian->urlnya;
        // //link terkait
        // $linkterkaits=  M_linkterkait::all();
        return view('frontend.index', compact('profils','banners'));
    }
    public function halaman()
    {
        //profil
        $profils=  M_profil::first();
        //page
        $page=  M_page::first();
        // dd($page);
        return view('medic.halaman',
        compact('profils','page'));
    }

}
