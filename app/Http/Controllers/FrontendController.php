<?php

namespace App\Http\Controllers;

// use App\Models\Api;

use App\Models\Kategori;
use App\Models\M_article;
use App\Models\M_banner;
use App\Models\M_faq;
use App\Models\M_komentar;
use App\Models\M_like;
use App\Models\M_profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FrontendController extends Controller
{
    public function index()
    {
        //profil
        $profils=  M_profil::first();
        //banner
        $banners=  M_banner::first();
        //blog
        $artikels= M_article::where('status','success')->orderby('publish','desc')->get()->take(3);
        $faqs= M_faq::with(['child'])->whereNull('parent_id')->get()->all();
        //faq
        // dd($faqs);

        return view('frontend.index', compact('profils','banners','faqs','artikels'));
    }
    public function blog()
    {
        //profil
        $profils=  M_profil::first();
        //banner
        $banners=  M_banner::first();
        //blog
        $artikels = M_article::where('status','success')->orderby('publish','desc')->paginate(5);
        //blogrecent
        $artikelrecents = M_article::where('status','success')->orderby('publish','desc')->get()->take(5);
        return view('frontend.blog',compact('profils','banners','artikels','artikelrecents'));
    }
    public function singleblog($slug)
    {
        //profil
        $profils=  M_profil::first();
        //banner
        $banners=  M_banner::first();
        //artikelread
        $artikel = M_article::with(['users','komentarnya','komentars','komentars', 'komentars.child', 'like'])->where('slug', $slug)->firstOrFail();
        // dd($artikel);
        $artikel_id=$artikel->id;
        if(Auth::check()) {
            //user is logged in
            $useryanglogin=Auth::user()->id;

            //cek apakah sudah kirim like/dislike
            $untuklikedislike= M_like::where('user_id',$useryanglogin)->where('artikel_id',$artikel_id)->first();
            if ($untuklikedislike !== null) {
                $linknya="likedislike.store";
                $linknyadis="updatedis";
                $awal="{--";
                $akhir="--}";
            } else {
                $linknya="likedislike.store";
                $linknyadis="createdis";
                $awal="{--";
                $akhir="--}";
            }
            //cek yang sudah kirim like per user
            $user_like = M_like::where('user_id',$useryanglogin)->where('like',1)->where('artikel_id',$artikel_id)->first();
            if($user_like !== null ){
                $fill_like="-fill";
            }else{
                $fill_like="";
            }
            //cek yang sudah kirim dislike per user
            $user_dislike = M_like::where('user_id',$useryanglogin)->where('dislike',1)->where('artikel_id',$artikel_id)->first();
            if($user_dislike !== null ){
                $fill_dislike="-fill";
                $linknya="likedislike.store";
            }else{
                $fill_dislike="";
            }
        }else{
                $awal="";
                $akhir="";
                $fill_like="";
                $linknya="";
                $fill_dislike="";
                $linknyadis="";
                $untuklikedislike="";

        }

        //hitungkomentar
        $hitung_komentar = M_komentar::where('artikel_id',$artikel_id)->get()->count();
        //hitunglike
        $hitung_like = M_like::where('like',1)->where('artikel_id',$artikel_id)->get()->count();
        //hitungdislike
        $hitung_dislike = M_like::where('dislike',1)->where('artikel_id',$artikel_id)->get()->count();
        //artikelrecent
        $artikelrecents = M_article::where('status','success')->orderby('publish','desc')->get()->take(5);
        //faq
        $faqs= M_faq::with(['child'])->whereNull('parent_id')->get()->all();

        return view('frontend.singleblog',compact('profils','banners','artikel','artikelrecents','faqs',
                    'hitung_komentar','hitung_like','fill_like','hitung_dislike','fill_dislike','linknya',
                    'linknyadis','awal','akhir','untuklikedislike'));
    }
    public function edit($id)
    {
        $artikel = M_article::find($id);
        $categories = Kategori::all();
        return view('livewire.article-update',compact('artikel','categories'));
    }
    public function update(Request $request,M_article $artikel)
    {
        $this->validate($request, [
            'user_id' =>'',
            'judul' => 'required',
            'description' => 'required',
            'publish' => 'required',
            'category_id' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,svg,gif|max:2048'
        ]);

        //check if image is uploaded
        if ($request->hasFile('image')) {

            //upload new image
            $image = $request->file('image');
            $image->storeAs('public/article', $image->hashName());

            //delete old image
            Storage::delete('public/article/'.$artikel->image);

            //update post with new image
            $artikel->update([
            'user_id'       => Auth::user()->id,
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul),
            'description'   => $request->description,
            'status'        => $request->status,
            'category_id'   => $request->category_id,
            'image'         => 'article/'.$image->hashName(),
            'publish'       => $request->publish
            ]);

        } else {

            //update post without image
            $artikel->update([
            'user_id'       => Auth::user()->id,
            'judul'         => $request->judul,
            'slug'          => Str::slug($request->judul),
            'description'   => $request->description,
            'status'        => $request->status,
            'category_id'   => $request->category_id,
            'publish'       => $request->publish
            ]);
        }
        return redirect()->route('article')
                        ->with('success','updated successfully');
    }

}
