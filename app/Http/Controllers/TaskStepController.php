<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Don't forget use DB
use DB;
use App\task;
use App\step;
use App\appoint;

class TaskStepController extends Controller
{
    /*Function บันทึกข้อมูล Task และ Step
    --------------------------------*/
    public function createTaskStep (Request $req) {
        $task = new task;
        $step = new step;

        //สร้าง object จาก Model task
        //-------- Save TASK ---------
        //สร้างตัวแปร cTask เพื่อเก็บค่า task ที่ถูกส่งมาจาก View
        $cTask = $req->get('task');
        //นำตัวแปร cTask มากำหนดค่าให้กับ Task Title
        $task->title = $cTask;
        //บันทึกลง DataBase Table Task
        $task->save();

        //-------- Save STEP ---------
        //เอาข้อมูล step ที่รับมาแปลงเป็น Json
        $stepData = collect($req->get('step'))->toJson();
        //decode ข้อมูลเพื่อให้สามารถเอาไปใช้ใน foreach ได้
        $stepDecode = json_decode($stepData);

        //กำหนดค่า taskid = id ของ taskที่ถูกสร้างล่าสุด
        $task_data = $task->get()->last();
        $task_id = $task_data->id;

        $i = 0;
        foreach($stepDecode as $val) {
            DB::table('step')->insert(
            [   'no'        => $i+1,
                'title'     => $stepDecode[$i],
                'task_id'   => $task_id
            ]);
            $i++;
        }

            return response()->json($req);
        }


        /*Function ดึงข้อมูล Task ทั้งหมด
        ---------------------------*/
        public function gettask() {
            $task = new task;
            $data = DB::table('task')->select('*')->where('id','<=',10)->get();
            return response($data);
        }

        /*Function ดึงข้อมูล Task Title
        --------------------------*/
        public function gettasktitle(Request $req) {
            //Request ที่ได้มาคือ ค่า id ที่จะเอามา get หา Task_Title
            $x = collect($req)->toJson();
            $id = json_decode($x);
            $title = DB::table('task')->select('title')->where('id', '=' , $id)->get();
            
            return response($title);
        }

        /*Function สร้างข้อมูลการนัดหมาย
        ----------------------------*/
        public function createAppoint(Request $req) {

            $x = collect($req)->toJson();
            $data = json_decode($x);
            $myDate = $data->DateTime;
            $myTaskId = $data->taskId;
            
            DB::table('appoint')->insert(['date'=> $myDate,'task_id' => $myTaskId]);
    
            return response($req);
        }

        
}
