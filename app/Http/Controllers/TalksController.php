<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Talks;

class TalksController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $Talks = Talks::all();

        return view('talks.all', ['Talks' => $Talks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('talks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = request()->validate([
            'title' => 'required|min:3|max:18',
            'url' => 'required|url'
        ]);
        Talks::create($data);
        redirect()->route('talks.index');
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
        $Talk = Talks::find($id);

        return view('talks.edit', ['Talk' => $Talk]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $Talk = Talks::find($id);
        $data = request()->validate([
            'title' => 'required|min:3|max:18',
            'url' => 'required|url'
        ]);
        $Talk->update($data);
        return redirect()->route('talks.index');
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
