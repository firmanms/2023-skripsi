<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Mail;
use App\Mail\DemoMail;

class UserController extends Controller
{
    // public function index()
    // {
    //     $users = User::paginate();

    //     return view('users.index', compact('users'));
    // }
    function __construct()
    {
         $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index','store']]);
         $this->middleware('permission:user-create', ['only' => ['create','store']]);
         $this->middleware('permission:user-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $users = User::orderBy('id','DESC')->paginate(25);
        return view('users.index',compact('users'))
            ->with('i', ($request->input('page', 1) - 1) * 25);
    }

    public function search(Request $request)
    {
        $keyword = $request->search;
        $users = User::where('name', 'like', "%" . $keyword . "%")->orwhere('email', 'like', "%" . $keyword . "%")->orwhere('code', 'like', "%" . $keyword . "%")->paginate(400);
        return view('users.index', compact('users'))->with('i', (request()->input('page', 1) - 1) * 400);
    }

    public function create()
    {
        $roles = Role::pluck('name','name')->all();
        return view('users.create',compact('roles'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User created successfully');
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('users.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.edit',compact('user','roles','userRole'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'statusnya' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }

    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
                        ->with('success','User deleted successfully');
    }
    public function approve($id)
    {
        $user = User::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $user->roles->pluck('name','name')->all();

        return view('users.approve',compact('user','roles','userRole'));
    }
    public function sendmail($id)
    {
        $user = User::find($id);
        $ambilnama=$user->name;
        $ambilemail=$user->email;
        $ambiljenis=$user->presenter;
        $mailData = [
            'title' => 'APPROVAL ACCOUNT',
            'body' => 'Hy, ' .$ambilnama.'',

        ];

        Mail::to($ambilemail)->send(new DemoMail($mailData));
        return redirect()->back()
                        ->with('success','Email is sent successfully.');

        //  dd("Email is sent successfully.");

        //return view('users.approve',compact('user','roles','userRole'));
    }
    public function updateapp(Request $request, $id)
    {
        $this->validate($request, [

            'statusnya' => 'required',

        ]);

        $input = $request->all();
        if(!empty($input['password'])){
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));
        }

        $user = User::find($id);
        $user->update($input);


        return redirect()->route('users.index')
                        ->with('success','User updated successfully');
    }
    public function config()
    {
         $users = User::where('category', 'not like', "%panitia%")->orderBy('id','ASC')->get();
         //dd($users);
        return view('users.report',compact('users'));

        // return view('user.config');
    }
    public function config2()
    {
         $users = User::where('category', 'not like', "%panitia%")->orderBy('id','ASC')->get();
         //dd($users);
        return view('users.reportv2',compact('users'));

        // return view('user.config');
    }
    public function report(Request $request){
        $category = $request->tgl_awal;
        $tgl_akhir = $request->tgl_akhir;
        $kelurahan = $request->kelurahan;
        $status = $request->status;
        $rw = $request->rw;
            $ktps = Kk::select('kartu_keluargas.*')->join('masters', 'kartu_keluargas.nik','=', 'masters.nik')
                        ->whereBetween('kartu_keluargas.tanggal', [$tgl_awal, $tgl_akhir])
                        ->when($kelurahan,function ($ktps, $kelurahan) {
                            return $ktps->where('masters.kelurahan', $kelurahan);})
                        ->when($status,function ($ktps, $status) {
                            return $ktps->where('kartu_keluargas.status', $status);})
                        ->when($rw,function ($ktps, $rw) {
                            return $ktps->where('masters.rw', $rw);})
                        ->orderby('kartu_keluargas.id','asc')
                        ->get();
       //dd($ktps);
        return view('user.report',compact('ktps','tgl_awal','tgl_akhir'));
    }

}
