<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\forum;
use App\Models\report;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {   $user= Auth::user();
        $users = User::where('role','<>', 'admin')->paginate(10);
        return view('admin.index',compact('users','user'),[
            'title' =>'EmoCare | Dashboard'
        ]);
    }


    public function show()
    {
        $user= Auth::user();
        $posting = report::where('jenis','postingan')->with('forum','user')->paginate(10);
        $komen = report::where('jenis','komentar')->with('forum','komen','user')->paginate(10);
        return view('admin.report',compact('user','posting','komen'),[
            'title' =>'EmoCare | Dashboard-Report'
        ]);
    }

    public function create_report(Request $request){

            if ($request->jenis == "postingan") {
                $kategori =  implode(' ,', $request->report);
                report::create([
                    'user_id' => $request->user,
                    'forum_id' => $request->forum,
                    'komentar_id'=>0,
                    'jenis'=>$request->jenis,
                    'kategory' => $kategori,
                    'pesan' => $request->pesan,
                ]);
                return redirect()->route('forum')->with(['success' => 'Berhasil Mereport!']);
            }elseif ($request->jenis == 'komentar') {
                $kategori =  implode(' ,', $request->report);
                report::create([
                    'user_id' => $request->user,
                    'forum_id' =>  $request->forum,
                    'komentar_id'=>$request->komen,
                    'jenis'=>$request->jenis,
                    'kategory' => $kategori,
                    'pesan' => $request->pesan,
                ]);
                return redirect()->route('forum')->with(['success' => 'Berhasil Mereport!']);
            }

    }

}
