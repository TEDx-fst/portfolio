<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class social_users extends Model {
 protected $fillable = [
        'user_id', 'social_id', 'url',
    ];

}
