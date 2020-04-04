<?php

namespace App\Http\Controllers;

use App\Artist;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $artists = Artist::all();
        return view('artists.index', ['artists'=>$artists]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response|\Illuminate\Contracts\Support\Renderable|\Illuminate\Http\JsonResponse
     */
    public function create()
    {
        if (request()->ajax()){
            $artists = Artist::with('user')->get();
            return response()->json($artists);
        }

        return view('artists.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');

        if ($request->input('email') !=null){
            $user->email = $request->input('email');
        }
        else{
            $user->email = str_replace(' ', '', "rmsosca+".$user->first_name."_".$user->last_name."@gmail.com");
        }
        $user->dob = $request->input('dob');
        $user->nic = $request->input('nic');
        $user->mobile = $request->input('mobile');
        $user->land = $request->input('land');
        $user->address = $request->input('address');
        $user->role = 3;
        $user->added_by = auth()->user()->id;
        $user->password = Hash::make($request->input('first_name'));
        $user->save();

        $artist = new Artist;
        $artist->user_id = $user->id;
        $artist->added_by = auth()->user()->id;
        $artist->membership_number = $request->input('membership_number');
        $artist->type = $request->input('type');
        $artist->status = $request->input('status');
        $artist->save();

        return redirect()->route('artists.index')->with('success', 'Successfully saved user & artist data!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function show(Artist $artist)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function edit(Artist $artist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Artist $artist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artist  $artist
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artist $artist)
    {
        //
    }
}
