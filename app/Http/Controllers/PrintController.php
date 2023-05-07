<?php

namespace App\Http\Controllers;

use App\Models\M_booking;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function prints($id)
    {

        $dataprint = M_booking::where('id',$id)->first();
        //dd($datasave);
        return view('print_booking',compact('dataprint'));
            //->with('i', (request()->input('page', 1) - 1) * 5);
        //return view('home');
    }

}
