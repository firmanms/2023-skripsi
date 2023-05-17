<?php

namespace App\Http\Controllers;

// use App\Models\Api;

use App\Models\Kategori;
use App\Models\M_article;
use App\Models\M_banner;
use App\Models\M_profil;
use Illuminate\Http\Request;
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
        //dd($artikels);

        return view('frontend.index', compact('profils','banners','artikels'));
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
        $artikel = M_article::where('slug', $slug)->firstOrFail();
        //artikelrecent
        $artikelrecents = M_article::where('status','success')->orderby('publish','desc')->get()->take(5);

        return view('frontend.singleblog',compact('profils','banners','artikel','artikelrecents'));
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
