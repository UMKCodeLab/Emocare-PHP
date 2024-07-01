<?php

namespace App\Http\Controllers;

use App\Models\aspirasi;
use App\Models\forum;
use App\Models\komentar;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function Psy\debug;

class ForumController extends Controller
{

    // display index halaman
    public function index()
    {
        $posts = aspirasi::orderBy('created_at', 'desc')
            ->select('title', 'body','id', DB::raw('SUBSTRING(body, 1, 100) as potongan_body'))->paginate(5);
        $user=Auth::user();
        $forum = forum::with('User')->orderBy('created_at', 'desc')->get();

        return view('main.index',compact('user','posts','forum'),[
            'title' => 'EmoCare|Home']);
    }

    // upload di halaman utama
    public function create(Request $request)
    {
        $user = Auth::user();
        $valid= Validator::make($request->all(),[
            'isi' => 'required',
            'image' => 'max:2048'
        ]);
        if ($valid->fails()) return redirect()->route('forum')->with('loginError','Gagal memposting, max gambar 2 Mb');
        //  dd($request->all());
        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/forumimg/'.$filename;
            Storage::disk('public')->put($path,file_get_contents($image));

        }else{
            $filename = null;
        }

        if ($request->anonim) {
            $anonim = $request->anonim;
        }else {
            $anonim = 0;
        }


        forum::create([
            'user_id' => $request->user,
            'isi' => $request->isi,
            'is_anonim' => $anonim,
            'image' => $filename
        ]);
        return redirect()->route('forum')->with(['success' => 'Berhasil Memposting!']);

    }

    //edit forum ini pip
    public function edit_forum($id){
         $user=Auth::user();
         $forum =  forum::find($id);
         return view('main.edit_forum', compact('user', 'forum'),[
            'title' => 'edit forum'
         ]);
    }

    //update forum ini pip
    public function update_forum(Request $request,$id)
    {
        $user = Auth::user();
        $valid= Validator::make($request->all(),[
            'image' => 'max:2048'
        ]);

        if ($valid->fails()) return redirect()->route('forum.edit',['id'=>$id])->with('loginError','Gagal mengedit, max gambar 2 Mb');

        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/forumimg/'.$filename;
            Storage::disk('public')->put($path,file_get_contents($image));

        }else{
            $filename = $request->default_image;
        }

        forum::whereId($id)->update([
            'user_id' => $request->user,
            'isi' => $request->isi,
            'is_anonim' => $request->anonim,
            'image' => $filename
        ]);
        return redirect()->route('forum')->with(['success' => 'Berhasil Mengedit!']);
    }

    // halaman komentar
    public function komentar(Request $request,$id)
    {
        $user=Auth::user();
        $coment=komentar::where('forum_id',$id)->with('forum')->get();
        $item = forum::find($id);
        return view('main.komentar',compact('item','user','coment'),[
            'title' => 'EmoCare | Forum',
            // 'forum' => forum::with('User')->get()
        ]);
    }

    // upload komentar
    public function komentar_proses(Request $request)
    {
        $valid= Validator::make($request->all(),[
            'isi' => 'required',
        ]);

        if ($valid->fails()) return redirect('komentar',['id'=>$request->forum])->withInput()->withErrors($valid);

        komentar::create([
            'forum_id'=>$request->forum,
            'user_id' => $request->user,
            'isi' => $request->isi
        ]);

        return redirect()->route('komentar',['id'=>$request->forum])->with(['success' => 'Berhasil Memposting!']);
    }

    // buka profile
    public function profile()
    {
        $user=Auth::user();
        $forum=forum::where('user_id',$user->id)->with('user')->orderBy('created_at', 'desc')->get();
        return view('main.profile',compact('user','forum'),[
            'title' => 'EmoCare | Profile'
        ]);
    }

    // upload postingan dari profile
    public function upload_profile(Request $request)
    {
        $user = Auth::user();
        $valid= Validator::make($request->all(),[
            'isi' => 'required',
            'image' => 'max:2048'
        ]);
        if ($valid->fails()) return redirect()->route('profile')->with('loginError','Gagal memposting, max gambar 2 Mb');
        //  dd($request->all());
        if($request->image){
            $image      =$request->file('image');
            $filename   =date('Y-m-d').$image->getClientOriginalName();
            $path       ='/forumimg/'.$filename;
            Storage::disk('public')->put($path,file_get_contents($image));

        }else{
            $filename = null;
        }

        if ($request->anonim) {
            $anonim = $request->anonim;
        }else {
            $anonim = 0;
        }


        forum::create([
            'user_id' => $request->user,
            'isi' => $request->isi,
            'is_anonim' => $anonim,
            'image' => $filename
        ]);
        return redirect()->route('profile')->with(['success' => 'Berhasil Memposting!']);
    }



    public function delete_forum($id)
    {
        $user = forum::findOrFail($id);

        $user->delete();

        return redirect()->route('forum')->with('success', 'Berhasil menghapus Postingan!');
    }

    public function delete_comment(Request $request,$id)
    {
        $user = komentar::findOrFail($id);

        $user->delete();

        return redirect()->route('komentar',['id'=>$request->forum_id])->with(['success' => 'Berhasil Menghapus Komentar!']);
    }
}
