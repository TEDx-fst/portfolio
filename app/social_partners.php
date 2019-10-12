<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class social_partners extends Model {

    protected $fillable = [
        'partner_id', 'social_id', 'url',
    ];

    function partner() {
        $this->belongsTo(partners::class);
    }

}
