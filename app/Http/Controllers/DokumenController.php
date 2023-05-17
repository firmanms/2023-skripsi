<?php

namespace App\Http\Controllers;

use App\Models\Dokumen;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;

class DokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter=Auth::user()->id;

        $documents = Dokumen::where('user_id',$filter)->latest()->paginate(5);

        return view('dokumen.index',compact('documents'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dokumen.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id'  =>'required',
            // 'id_user' => 'required',
            'judul' => 'required',
            'image' => 'required|mimes:pdf|max:50000',
        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('/images'), $profileImage);
            $input['image'] = "$profileImage";
        }

        Dokumen::create($input);

        return redirect()->route('document.index')
                        ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Dokumen $document)
    {
        $filter=Auth::user()->id;
        $filter2=$document->user_id;
        // dd($document);
         if($filter==$filter2){
             return view('dokumen.show',compact('document'));
         }else{
              abort(404);
         }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Dokumen $document)
    {
        $filter=Auth::user()->id;
        $filter2=$document->user_id;
        //dd($filter2);
         if($filter==$filter2){
             return view('dokumen.edit',compact('document'));
         }else{
              abort(404);
         }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dokumen $document)
    {
        $request->validate([
            'user_id'  =>'required',
            // 'id_user' => 'required',
            'judul' => 'required',
            'image' => 'mimes:jpeg,png,jpg,pdf',

        ]);

        $input = $request->all();

        if ($image = $request->file('image')) {
            $destinationPath = 'images/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }

        $document->update($input);

        return redirect()->route('document.index')
                        ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dokumen $document)
    {
        $document->delete();

        return redirect()->route('document.index')
                        ->with('success','Post has been deleted successfully');
    }
}
