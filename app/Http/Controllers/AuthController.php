<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    // Tampilan Login
    public function index(){
        return view('auth.login',[
            'title' => 'Login',
        ]);
    }


    // Proses Login
    public function authenticate(Request $request){
        // dd($request->all()); -> nyoba file masuk tidak
        $request->validate([
            'username' =>'required',
            'password' =>'required',
        ]);

        $data =[
            'username' =>$request->username,
            'password' =>$request->password
        ];


        if (Auth::attempt($data)) {
            if (isset($request['remember']) &&!empty($request['remember'])) {
                setcookie("username",$request['username'],time()+3600);
                setcookie("password",$request['password'],time()+3600);
            }else {
                setcookie("username","");
                setcookie("password","");
            }
            return redirect()->intended('/');
        }
        return back()->with('loginError','Login failed!');
    }


    // Proses Logout

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('success', 'Kamu berhasil Logout!');
    }


    // Tampilan Registrasi

    public function reg(){
        return view('auth.register',[
            'title' => 'Register',
        ]);
    }


    // Proses Registrasi

    public function create(Request $request){
        $valid= Validator::make($request->all(),[
            'username' => 'required|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ]);
        if ($valid->fails()) return redirect()->back()->withInput()->withErrors($valid);
        User::create([
            'username' => $request->username,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('biodata')->with(['success' => 'Register Berhasil, Silahkan lengkapi data!','username'=>$request->username]);
    }


    //lengkapi data

    public function bioData(){
        return view('auth.biodata',[
            'title' => 'Register',
        ]);
    }


    //proses lengkapi data

    public function createBio(Request $request){
        $valid= Validator::make($request->all(),[
            'firstname' => 'required',
            'lastname' => 'required',
            'lahir' => 'required',
            'status' => 'required|max:300',
            'image' => 'mimes:png,jpg,jpeg'
        ]);
        if ($valid->fails()) return redirect()->route('login')->with('loginError','Gagal mengisi Biodata, silahkan isi di pengaturan setelah login!');
        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/profilepicture/'.$filename;

            Storage::disk('public')->put($path,file_get_contents($image));

        }else{
            $filename = null;
        }

        $users = DB::table('users')->where('username', $request->username)->latest()->first();

        User::where('username',$users->username)->
        update([
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'tanggal_lahir' => $request->lahir,
            'status' => $request->status,
            'image' => $filename
        ]);
        return redirect()->route('login')->with(['success' => 'Register Berhasil, Silahkan Login!']);
    }

    //setting profile

    public function profile_setting(Request $request,$id){
        $user=Auth::user();
        $item= User::find($id);
        return view('main.settingProfile',compact('user','item'),[
            'title' => 'EmoCare | Profile-Setting',
        ]);
    }

    //masuk setting profile

    public function edit_profile(Request $request,$id){
        $valid= Validator::make($request->all(),[
            'status' => 'max:300',
            'image' => 'mimes:png,jpg,jpeg',
            ]);
        if ($valid->fails()) return redirect()->back()->withInput()->withErrors($valid);
        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/profilepicture/'.$filename;

            Storage::disk('public')->put($path,file_get_contents($image));

            User::whereId($id)->
            update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'tanggal_lahir' => $request->lahir,
                'status' => $request->status,
                'image' => $filename
            ]);
            return redirect()->route('forum')->with(['success' => 'Update Profile Berhasil!']);
        }else{
            User::whereId($id)->
            update([
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'username' => $request->username,
                'tanggal_lahir' => $request->lahir,
                'status' => $request->status,
            ]);
            return redirect()->route('forum')->with(['success' => 'Update Profile Berhasil!']);
        }
    }


}
