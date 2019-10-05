<?php

use App\socialmedia;
use Illuminate\Database\Seeder;

class SocialmediaTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $socilMediaArray = [
            ['socail_media' => 'facebook', 'icon' => 'fa fa-facebook'],
            ['socail_media' => 'twitter', 'icon' => 'fa fa-twitter'],
            ['socail_media' => 'linkedin', 'icon' => 'fa fa-linkedin'],
            ['socail_media' => 'behance', 'icon' => 'fa fa-behance']
        ];


        foreach ($socilMediaArray as $social) {
            $test = new socialmedia();
            $test->social_media = $social['socail_media'];
            $test->social_media_icon = $social['icon'];
            $test->save();
        }
    }

}
