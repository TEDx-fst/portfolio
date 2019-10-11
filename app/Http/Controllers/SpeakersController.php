<?php

namespace App\Http\Controllers;

use App\speakers as SpeakersModel;
use Illuminate\Http\Request;
use App\speakers_social;
use File;
use App\socialmedia;
use Intervention\Image\Facades\Image;

class SpeakersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Speakers = SpeakersModel::all();

        return view('speakers.all', ['Speakers' => $Speakers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $SocialMedia = socialmedia::all();
        $CreateViewData = ['SocialMediaData' => $SocialMedia];
        return view('speakers.create', $CreateViewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = request()->validate([
            'name' => 'required|min:3|max:18|alpha',
            'description' => 'required',
            'image' => ['required', 'image']
        ]);

        $data['image'] = request('image')->store('uploads/speakers', 'public');

        $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);

        $image->save();

        $Speaker = SpeakersModel::create($data);

        $SocialSpeaker = count(request('social'));

        for ($counter = 0; $SocialSpeaker > $counter; $counter++) {
            $SocialMediaId = request('social')[$counter];
            $SocialMediaUrl = request('SocilUrl')[$counter];

            (new speakers_social())->create(['speaker_id' => $Speaker->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
        }

        return redirect()->route('speakers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {

        $Speaker = SpeakersModel::find($id);
        $SocialMedia = socialmedia::all();
        
        dd($Speaker->social);
        
        $SpeakerEditView = ['speaker' => $Speaker, 'SocialMediaData' => $SocialMedia];
        return view('speakers.edit', $SpeakerEditView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\speakers  $speakers
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
