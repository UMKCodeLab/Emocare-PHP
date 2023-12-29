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
        // dd($request->all());
        $request->validate([
            'username' =>'required',
            'password' =>'required',
        ]);

        $data =[
            'username' =>$request->username,
            'password' =>$request->password
        ];

        // if (Auth::attempt($data)) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/home');
        // }
        if (Auth::attempt($data)) {
            if (isset($request['remember']) &&!empty($request['remember'])) {
                setcookie("username",$request['username'],time()+3600);
                setcookie("password",$request['password'],time()+3600);
            }else {
                setcookie("username","");
                setcookie("password","");
                // $request->session()->regenerate();
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
            // 'image' => $filename
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
            'image' => 'required|mimes:png,jpg,jpeg'
        ]);
        if ($valid->fails()) return redirect()->back()->withInput()->withErrors($valid);

        $image      =$request->file('image');
        $filename   =date('Y-m-d').$image->getClientOriginalName();
        $path       ='/profilepicture/'.$filename;

        Storage::disk('public')->put($path,file_get_contents($image));
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
}
