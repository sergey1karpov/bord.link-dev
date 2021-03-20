<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    public function profile() {
        return $this->belongsTo(Profile::class);
    }
}
