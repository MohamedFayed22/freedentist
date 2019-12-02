<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
  public function user()
  {
    return $this->belongsToMany(User::class);
  }

}
