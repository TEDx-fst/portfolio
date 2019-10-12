<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class social_speaker extends Model {

    protected $fillable = [
        'speaker_id', 'social_id', 'url',
    ];

    public function speakers() {
        return $this->belongsTo(speakers::class);
    }

}
