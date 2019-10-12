<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class speakers extends Model {

    protected $fillable = [
        'name', 'description', 'image',
    ];

    function social() {
        return $this->hasMany(social_speaker::class);
    }

}
