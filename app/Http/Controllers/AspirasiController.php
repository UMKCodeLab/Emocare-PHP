<?php

namespace App\Http\Controllers;

use App\Models\aspirasi;
use App\Http\Requests\UpdatepostinganRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{

    //tampilan aspirasi

    public function index()
    {
        $posts = aspirasi:: with('user')->get();
        $user = Auth::user();
        return view('aspirasi.index',compact('posts','user'),[
            'title' =>'EmoCare | Aspirasi'
    ]);
    }

    //buat aspirasi

    public function create(Request $request)
    {
        $user=Auth::user();
        return view('aspirasi.create',compact('user'),[
            'title' =>'EmoCare | Aspirasi-Create'
        ]);
    }

    //proses upload aspirasi

    public function store(Request $request)
    {

        $user = Auth::user();
        $valid= Validator::make($request->all(),[
            'title'=> 'required',
            'body' => 'required',
            'image' => 'max:2048'
        ]);
        if ($valid->fails()) return redirect()->route('create.content')->with('loginError','Gagal memposting, max gambar 2 Mb');
        //  dd($request->all());
        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/aspirasi/'.$filename;
            Storage::disk('public')->put($path,file_get_contents($image));

        }else{
            $filename = null;
        }

        aspirasi::create([
            'user_id' => $request->user,
            'title' => $request->title,
            'body' => $request->body,
            'image' => $filename
        ]);
        return redirect()->route('aspirasi')->with(['success']);
    }

    //display full aspirasi

    public function show(aspirasi $aspirasi,$id)
    {
        $user = Auth::user();
        $data = aspirasi::find($id);
        return view('aspirasi.content', compact('data','user'),[
            'title' => 'aspirasi content'
        ]);
    }
}
