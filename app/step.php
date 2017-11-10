<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class step extends Model
{
    protected $table = "Reminder";
    public $primarykey = "id";
    public $timestamps = true;

    public function task ()
    {
      return $this->belongsTo(task::class, 'task','id');
    }
}
