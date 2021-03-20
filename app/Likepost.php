<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Likepost extends Model
{
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
