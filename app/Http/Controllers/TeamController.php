<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\socialmedia;
use Intervention\Image\Facades\Image;
use Sentinel;

class TeamController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Users = User::all();

        return view('team.all', ['Users' => $Users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $SocialMedia = socialmedia::all();
        $roles = Sentinel::getRoleRepository()->all();
        return view('team.create', ['SocialMediaData' => $SocialMedia, 'Roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = request()->validate([
            'email' => 'required|unique:users,email|email',
            'first_name' => 'required|min:3|max:18|alpha',
            'last_name' => 'required|min:3|max:18|alpha',
            'image' => ['required', 'image']
        ]);

        $data['password'] = str_random(8);
        $data['image'] = request('image')->store('uploads/team', 'public');

        $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);

        dd(request());


//        $image->save();
//        $user = Sentinel::registerAndActivate($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
