@extends('layouts.template') @section('title', 'Task') @section('content') 
&nbsp
<div name="Input">
    <form action="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <table>
            <tr>
                <td>Task Title:</td>
                <td>
                    <input type="text" name="task_title" id="task_title"> 
                    &ensp;
                    <span class="ui button primary" name="create_task_title" id="create_task_title">
                        Create Task Title
                    </span>
                </td>
            </tr>
            <tr>
                <td>Step:</td>
                <td>
                    <input type="text" name="step_title" id="step_title">
                    &ensp;
                    <span class="ui button primary" name="create_step" id="create_step">
                        Create Step
                    </span>
                </td>
            </tr>
        </table>
    </form>
</div>

<div name="Show" class="ui stacked segment">
    <table>
        <tr>
            <td>Show</td>
        </tr>
        <tr>
            <td>Task :</td>
            <td>
                <label name="show_task" id="show_task"></label>
            </td>
        </tr>
        <tr>
            <td>Step :</td>
            <td>
                <ol name="show_step" id="show_step"></ol>
            </td>
        </tr>
        <tr>
            <td></td>
            <td>
                <span class="ui button positive" id="submit" name="submit">Submit</span>
            </td>
        </tr>
    </table>
    
</div>

<script type="text/javascript">
    $.ajaxSetup({
	    headers: {
		    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
    });
   

    $(document).ready(function () {
            var task = "";
            var step = [];
            var jsonString;

            //Function Create Task
            $("#create_task_title").click(function () {

                /*
                พอกดปุ่ม Create Task Title จะเอาค่ามาใส่ตัวแปร x เพื่อตัดช่องว่าง เพื่อตรวจสอบค่าว่าง
                -ถ้าเป็นค่าว่าง ก็จะโชว๋ Task is Empty!! แล้ว return ออก
                -ถ้าไม่เป็นค่าว่าง จะเอาค่าของตัวแปร x ไปใส่ใน task
                */
                var x = $("#task_title").val();
                
                //Check Input Value
                x = x.trim();
                if(x == ""){
                    alert("Task is Empty!!");
                    return;
                }

                //TODO
                task = x;                
                $("#show_task").html(task);
                $("#task_title").val("");
            });

            //Function Create Step
            $("#create_step").click(function () {
                var x = $("#step_title").val();

                //Check Input Value
                x = x.trim();
                if(x == "") {
                    alert("Step input is Empty!!");
                    return;
                }


                var len = step.length;
                step[len] = x;

                $("#show_step").append("<li name='li_step'>" + step[len] + "</li>");
                $("#step_title").val("");
            });

            //Function Submit
            $("#submit").click(function () {
               
                //alert("Task : " + task + " | " + "Step : " + step);
                //Check Task value
                if(task == "") {
                    alert("Task is Empty!!!");
                    return;
                }

                //Check Step value
                if(step.length == 0) {
                    alert("Not have step value!!");
                    return;
                }

                var obj = new Object();
                    obj.task = task;
                    obj.step = step;

                jsonString = JSON.stringify(obj);
                
                //alert("JSON.stringify: " + jsonString)
                //alert('{{csrf_token()}}');

                $.ajax({
                    type: "POST",
                    url: "task",
                    /*data:{_token: '{{csrf_token()}}',
                           d: jsonString},
                    */
                    data: jsonString,
                    contentType: "application/json; charset=utf-8",
                    dataType: 'json',
                    success: function(data){
                        //เอา data ที่ return มาแปลงเป็น json
                        var qw = JSON.stringify(data);
                        // parse ข้อมูลเพื่อให้ใช้ได้
                        var wqs = JSON.parse(qw)
                        //ทดลองแสดงค่า
                        alert("Create Data Success");
                       
                        data = "";
                        task = "";
                        step = [];

                        //ข้อความ task ใช้วิธีเอาค่าว่างมาทับ
                        $("#show_task").html(task);
                        //ข้อความ step ใช้วิธี hide ด้วย ElementByName
                        var hideElement = document.getElementsByName("li_step");
                        $(hideElement).hide();
                    },
                    error: function (data) {
                            alert('Error: Process has problem!!', data);
                        }
                });
            });
        });
</script>

@endsection