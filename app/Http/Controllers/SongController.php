<?php

namespace App\Http\Controllers;

use App\Artist;
use App\Song;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\JsonResponse
     */
    public function index()
    {
        if(request()->ajax()){
            $songs = Song::with([
                'addedUser',
                'approvedUser',
                'singers.user',
                'musicians.user',
                'writers.user',
                'producers.user',
            ])->get();
            return response()->json($songs);
        }

         return view('songs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $artists = Artist::all();
        return view('songs.create', ['artists' => $artists]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        if ($request->hasFile('song')) {
            $song = new Song;
            $song->title = $request->input('title');
            $song->details = $request->input('details');
            $song->released_at = $request->input('released_at');
            $song->added_by = auth()->user()->id;
            if (auth()->user()->isAdmin()){
                $song->approved_by = auth()->user()->id;
            }
            $song->save();
            $song->artists()->attach($request->input('singers'), ['type' => 1]);
            $song->artists()->attach($request->input('musicians'), ['type' => 2]);
            $song->artists()->attach($request->input('writers'), ['type' => 3]);
            $song->artists()->attach($request->input('producers'), ['type' => 4]);

            $file = $request->file('song');
            $file_name = $song->id.".".$file->getClientOriginalExtension();
            $path =$file->storeAs('songs', $file_name, 'public');

            $song->file_path = '/storage/'.$path;

            $song->save();

            return response("Successfully Uploaded the song", 200);
        }
        else {
            return response("Please add a valid song file", 422);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }

    /**
     * Get song titles list.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function getSongTitles(Request $request)
    {
        $song_titles = Song::all('title');
        return response()->json($song_titles);
    }
}
