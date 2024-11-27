<?php

namespace App\Http\Controllers;

use App\tvscreen;
use App\playlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TvScreenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function all(Request $request)
    {
        $playlist = playlist::all();
        $tvscreen = tvscreen::all();

        return view('tvscreen.all', compact('playlist','tvscreen'));
    }

    public function addTvscreen(Request $request)
    {

        tvscreen::create([
            'title'         => $_POST['title'],
            'size'          => $_POST['size'],
            'playlist_name'   => $_POST['playlist_name'],
            'tvscreen_loc'  => $_POST['tvscreen_loc'],
        ]); 

        return redirect()->back()->with('message', 'Added successfully');
    }

    public function GetSubPlaylist($id){
        echo json_encode(DB::table('playlists')->where('orientation', $id)->distinct()->get('pl_name'));
    }

    public function GetTvScreenID($play_name){
        echo json_encode(DB::table('tvscreens')->where('playlist_name', $play_name)->get('id'));
    }

    public function GetVideoList($play) {
        /* echo json_encode(
            DB::table('tvscreens')
                ->join('playlists', 'tvscreens.playlist_name', '=', 'playlists.pl_name')
                ->join('medias', 'playlists.media_id', '=', 'medias.id')
                ->where('tvscreens.id', $play)
                ->get('location')
        ); */

        $playlist_name = DB::table('tvscreens')
                ->join('playlists', 'tvscreens.playlist_name', '=', 'playlists.pl_name')
                ->join('medias', 'playlists.media_id', '=', 'medias.id')
                ->where('tvscreens.id', $play)
                ->get();
        return response()->json(['playlist_name' => $playlist_name]);
    }

    public function play($playlist_id)
    {
        
        return view('tvscreen.play',compact('playlist_id'));
    }
}
