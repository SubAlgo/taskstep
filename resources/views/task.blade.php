@extends('layouts.template') @section('title', 'Task') @section('content') 
&nbsp
<div name="Input">
    <form action="">
        <table>
            <tr>
                <td>Task Title:</td>
                <td>
                    <input type="text" name="task_title" id="task_title"> 
                    &ensp;
                    <span class="ui button primary" name="create_task_title" id="create_task_title" onclick="createTask()">
                        Create Task Title
                    </span>
                </td>
            </tr>
            <tr>
                <td>Step:</td>
                <td>
                    <input type="text" name="step_title" id="step_title">
                    &ensp;
                    <span class="ui button primary" name="create_step" id="create_step" onclick="createStep()">
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
                <span class="ui button positive" id="submit" name="submit" onclick="submitValue()">Submit</span>
                <div id="demo">aa</div>
            </td>
        </tr>
    </table>
    
</div>

<script>

    // สร้าง Global var task, step[]
    var task = "";
    var step = [];

    //Function CreateTask()
    function createTask() {
        var task;
        task = document.getElementById("task_title").value;

        // Check Empty value!!
        task = task.trim();
        if(task == ""){
            alert("Task Value is empty!!");
        } else{
            this.task = task;
            // เอา this.task ไปแสดงที่ <label id="show_task"> 
            document.getElementById('show_task').innerHTML = this.task;   
        }
    }

    //Function CreateStep()
    function createStep() {
        var step;
        step = document.getElementById('step_title').value;
        
        //Check Empty value!!
        step = step.trim();
        if(step == "") {
            alert("Step Value is empty!!");
        } else {
            //check สมาชิก array ทั้งหมดของ this.step เพื่อจะเอาค่าที่กรอกไปเก็บไว้ที่ index หลังสุด
            x = this.step.length;
            this.step[x] = step;

            //สร้าง Element 'li' เก็บไว้ในตัวแปร li เพื่อจะเอาไปแทรกใน <ol name="show_step">
            var li = document.createElement('li');
            //สร้างตัวแปร txtShow ไว้เก็บ object TextNode เพื่อใช้สร้าง li
            var txtShow = document.createTextNode(this.step[x]);
            //ใน li ที่สร้างให้แทรก text ที่รับค่า txtShow
            li.appendChild(txtShow);
            //เอา object li ที่สร้างไปแทรกใน Element <ol id='show_step'>
            document.getElementById('show_step').appendChild(li);

            //Clear กล่อง input step
            document.getElementById('step_title').value="";
        }
    }

    
    function submitValue() {
        if(this.task == "") {
            alert("Task is empty!!");
            return
        }

        if(this.step.length == 0) {
            alert("Step is empty!!");
            return
        }

        //Show this.task
        alert(this.task);

        //Show this.step[]
        var len = this.step.length;
        for(i=0; i < len; i++) {
            alert("Step["+ (i+1)  +"]"+ this.step[i]);
        }

        //Create JsonObject
        var obj = new Object();
        obj.task = this.task;
        obj.step = this.step;

        var jsonString = JSON.stringify(obj);

        alert(jsonString);
        

    }
    $(document).ready(function(){
        var obj = new Object();
        obj.task = this.task;
        obj.step = this.step;

        var jsonString = JSON.stringify(obj);
        
        $("#submit").click(function () {
            var ta = $("#task_title").val()
            alert(ta);
            $("#demo").hide();
        });
    });
    


</script>





@endsection