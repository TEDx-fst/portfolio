<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\socialmedia;
use App\social_users;
use Intervention\Image\Facades\Image;
use Sentinel;
use App\Mail\userEmail;
use Illuminate\Support\Facades\Mail;
use File;

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
        $user = Sentinel::registerAndActivate($data);
        $image->save();
        $role = Sentinel::findRoleById(request('role'));
        $role->users()->attach($user);

        $SocialUser = count(request('social'));

        for ($counter = 0; $SocialUser > $counter; $counter++) {
            $SocialMediaId = request('social')[$counter];
            $SocialMediaUrl = request('SocilUrl')[$counter];

            (new social_users())->create(['user_id' => $user->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
        }

        Mail::to($data['email'])->send(new userEmail($data));
        return redirect()->route('team.index');
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
        $user = User::find($id);
        $SocialMedia = socialmedia::all();
        $roles = Sentinel::getRoleRepository()->all();
        $UserSocialMedia = $user->social;
        $ViewArray = ['user' => $user, 'SocialMediaData' => $SocialMedia, 'Roles' => $roles, 'UserSocial' => $UserSocialMedia];
        return view('team.edit', $ViewArray);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $user = Sentinel::findById($id);

        $data = request()->validate([
            'email' => 'required|email',
            'first_name' => 'required|min:3|max:18|alpha',
            'last_name' => 'required|min:3|max:18|alpha',
            'image' => 'image'
        ]);

        if (!empty(request('image'))) {

            File::delete(public_path("/storage/" . $user->image));
            $data['image'] = request('image')->store('uploads/team', 'public');
            $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);
            $image->save();
        }

        $data['password'] = $user->password;

        $role = Sentinel::findRoleById(request('role'));

        $role->users()->detach($user);

        $user = Sentinel::update($user, $data);

        $role->users()->attach($user);

        social_users::where('user_id', $user->id)->delete();

        if (!empty(request('social'))) {
            $SocialCount = count(request('social'));

            for ($counter = 0; $SocialCount > $counter; $counter++) {
                $SocialMediaId = request('social')[$counter];
                $SocialMediaUrl = request('SocilUrl')[$counter];

                (new social_users())->create(['user_id' => $user->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
            }
        }


        return redirect()->route('team.index');
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
