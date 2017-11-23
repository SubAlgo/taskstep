<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class appoint extends Model
{
    protected $table = "appoint";
    public $primarykey = "id";
    public $timestamps = false;

    public function task ()
    {
      return $this->belongsTo('App\task', 'task_id');
      //return $this->belongsTo('App\task', 'foreign_key');
      //return $this->belongsTo('App\task', 'foreign_key', 'other_key');
    }
}
