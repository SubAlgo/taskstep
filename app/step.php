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
      //return $this->belongsTo(task::class, 'task','id');
      return $this->belongsTo('App\task');
      //return $this->belongsTo('App\task', 'task_id'); //arg[2] คือ  'foreign_key'
    }
}
