<?php

namespace App\Http\Controllers;

use App\speakers as SpeakersModel;
use Illuminate\Http\Request;
use App\social_speaker;
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

            (new social_speaker())->create(['speaker_id' => $Speaker->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
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
        $SpeakerSocail = social_speaker::where('speaker_id', $id)->get();

        $SpeakerEditView = ['speaker' => $Speaker, 'SpeackerSocial' => $SpeakerSocail, 'SocialMediaData' => $SocialMedia];
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
        $speaker = SpeakersModel::find($id);

        $data = request()->validate([
            'name' => 'required|min:3|max:18',
            'description' => 'required',
            'image' => ['required', 'image']
        ]);

        if (!empty(request('image'))) {

            File::delete(public_path("/storage/" . $speaker->image));
            $data['image'] = request('image')->store('uploads/speakers', 'public');
            $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);
            $image->save();
        }

        $speakerUpdate = $speaker->update($data);

        social_speaker::where('speaker_id', $speaker->id)->delete();

        if (!empty(request('social'))) {
            $SocialCount = count(request('social'));

            for ($counter = 0; $SocialCount > $counter; $counter++) {
                $SocialMediaId = request('social')[$counter];
                $SocialMediaUrl = request('SocilUrl')[$counter];

                (new social_speaker())->create(['speaker_id' => $speaker->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
            }
        }


        return redirect()->route('speakers.index');
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
