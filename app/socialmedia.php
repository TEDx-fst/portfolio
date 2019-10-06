<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class socialmedia extends Model {

    public function user() {
        $this->belongsToMany(User::class);
    }

}
