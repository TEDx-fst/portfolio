<?php

namespace App\Http\Controllers;

use App\partners;
use App\social_partners;
use Illuminate\Http\Request;
use File;
use App\socialmedia;
use Intervention\Image\Facades\Image;

class PartnersController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Partners = partners::all();

        return view('partners.all', ['Partners' => $Partners]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $SocialMedia = socialmedia::all();
        $CreateViewData = ['SocialMediaData' => $SocialMedia];
        return view('partners.create', $CreateViewData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = request()->validate([
            'name' => 'required|min:3|max:18',
            'description' => 'required',
            'image' => ['required', 'image']
        ]);

        $data['image'] = request('image')->store('uploads/partners', 'public');

        $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);

        $image->save();

        $Partner = partners::create($data);

        $SocialSpeaker = count(request('social'));

        for ($counter = 0; $SocialSpeaker > $counter; $counter++) {
            $SocialMediaId = request('social')[$counter];
            $SocialMediaUrl = request('SocilUrl')[$counter];

            (new social_partners())->create(['partner_id' => $Partner->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
        }

        return redirect()->route('partners.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function show(partners $partners) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $Partner = partners::find($id);
        $SocialMedia = socialmedia::all();
        $PartnerSocail = social_partners::where('partner_id', $id)->get();

        $PartnerEditView = ['Partner' => $Partner, 'PartnerSocial' => $PartnerSocail, 'SocialMediaData' => $SocialMedia];
        return view('partners.edit', $PartnerEditView);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $partner = partners::find($id);

        $data = request()->validate([
            'name' => 'required|min:3|max:18',
            'description' => 'required',
            'image' => ['required', 'image']
        ]);

        if (!empty(request('image'))) {

            File::delete(public_path("/storage/" . $partner->image));
            $data['image'] = request('image')->store('uploads/partners', 'public');
            $image = Image::make(public_path("storage/{$data['image']}"))->fit(1200, 1200);
            $image->save();
        }

        $partnerUpdate = $partner->update($data);

        social_partners::where('partner_id', $partner->id)->delete();

        if (!empty(request('social'))) {
            $SocialCount = count(request('social'));

            for ($counter = 0; $SocialCount > $counter; $counter++) {
                $SocialMediaId = request('social')[$counter];
                $SocialMediaUrl = request('SocilUrl')[$counter];

                (new social_partners())->create(['partner_id' => $partner->id, 'social_id' => $SocialMediaId, 'url' => $SocialMediaUrl]);
            }
        }


        return redirect()->route('partners.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\partners  $partners
     * @return \Illuminate\Http\Response
     */
    public function destroy(partners $partners) {
        //
    }

}
