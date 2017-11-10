<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class task extends Model
{
    protected $table = "task";
    public $primarykey = "id";
    public $timestamps = false;

    public function step ()
  {
    return $this->hasMany(step::class, 'ReminderType', 'id')->get();
  }
}
