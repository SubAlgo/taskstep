<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class step extends Model
{
    protected $table = "step";
    public $primarykey = "id";
    public $timestamps = false;

    public function task ()
    {
      return $this->belongsTo(task::class, 'task','id');
    }
}
