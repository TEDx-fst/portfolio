<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talks extends Model {

    protected $fillable = [
        'title', 'url'
    ];

}
