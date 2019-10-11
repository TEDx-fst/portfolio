<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class speakers_social extends Model {

    protected $fillable = [
        'speaker_id', 'social_id', 'url',
    ];

    public function speaker() {
        return $this->belongsTo(speakers::class);
    }

}
