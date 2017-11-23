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
    //return $this->hasMany(step::class, 'step', 'id')->get();
    return $this->hasMany('App\step');
  }

    public function appoint ()
  {
    return $this->hasMany('App\appoint');
    //$task->find(1)->appoint;
  }
  
  /*ตัวอย่างการ join
  DB::table('task')->join('step', 'task.id' ,'=', 'step.task_id')->select('task.*', 'step.no', 'step.title')->get();
  */
}
