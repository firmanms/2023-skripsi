<?php

namespace App\Http\Controllers;

use App\Models\Jawaban;
use App\Models\User;

use Auth;
use Illuminate\Http\Request;

class JawabanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter=Auth::user()->id;
        
        $jawabans = Jawaban::where('user_id',$filter)->latest()->paginate(5);
    
        return view('jawaban.index',compact('jawabans'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('jawaban.create');
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
            'status' => 'required',
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'filejawabans/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move(public_path('/filejawabans'), $profileImage);
            $input['image'] = "$profileImage";
        }
    
        Jawaban::create($input);
     
        return redirect()->back()->with('success','Post has been deleted successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Jawaban $jawaban)
    {
        return view('jawaban.show',compact('jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Jawaban $jawaban)
    {
        return view('jawaban.edit',compact('jawaban'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jawaban $jawaban)
    {
        $request->validate([
            'user_id'  =>'required',
            // 'id_user' => 'required',
            'judul' => 'required',
            'image' => 'mimes:pdf',
            
        ]);
  
        $input = $request->all();
  
        if ($image = $request->file('image')) {
            $destinationPath = 'filejawabans/';
            $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            $image->move($destinationPath, $profileImage);
            $input['image'] = "$profileImage";
        }else{
            unset($input['image']);
        }
          
        $jawaban->update($input);
    
        return redirect()->back()->with('success','Post has been deleted successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jawaban $jawaban)
    {
        $jawaban->delete();
    
        return redirect()->back()->with('success','Post has been deleted successfully');
    }
}
