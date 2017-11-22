@extends('layouts.template') @section('title', 'Calendar') @section('content')

&nbsp

<div class="ui stacked segment">
    <label for="date">วันเวลานัดหมาย</label>
    <br>
    <label for="date">วัน/เดือน/ปี</label>
    <input type="text" id="date" placeholder="วัน/เดือน/ปี">
    <span class="ui button primary" name="show_val" id="show_date">Select date value</span>
     &nbsp
    <label for="time">เวลา</label>
    <input type="time" id="myTime" value="00:00">
    <span class="ui button primary" name="show_val" id="show_time">Select time value</span>
</div>

<div class="ui stacked segment">
    <label for="">TaskList</label>

    <select id="showTaskList">
        <option value="">Pleace select task</option>
    </select>

</div>

<div class="ui stacked segment">
    <p>
        <label for="">Date:</label>
        <label for="" id="showDate">---</label>
    </p>

    <p>
        <label for="">Time:</label>
        <label for="" id="showTime">---</label>
    </p>

    <p>
        <label for="">Task:</label>
        <label for="" id="showTask">---</label>
    </p>
    <span class="ui button primary" name="save_db" id="save_db">Save to Database</span>
    <span class="ui button positive" name="create_ical" id="create_ical">Create ical file</span>
    
</div>




<script src="{{elixir('js/glDatePicker.min.js')}}"></script>
<script src="{{elixir('js/create_val.js')}}"></script>


<script type="text/javascript">
    var vDate = ''      //เก็บค่า วัน/เดือน/ปี
    var vTime = ''      //เก็บค่า เวลา
    var vTaskTitle = '' //เก็บค่า TaskTitle
    var vTaskid = ''    //เก็บค่า TaskId
    var vData = ''      //เก็บค่า JSON.parse(myData)

     $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    $(window).load(function () {
        $('#date').glDatePicker()
        //----Load task
        $.ajax({
            type: "GET",
            url: "gettask",
            dataType: 'json',
            success: function(data){
                var i = 0;
                var myData = JSON.stringify(data)
                var dataParse = JSON.parse(myData)
                vData = dataParse             
                dataParse.forEach(function (element) {                   
                   $('#showTaskList').append("<option id='opttask' value="+element.id+">"+element.title+"</option>")
                });
                
                //alert("Number of data : " + i);
                //alert("parse da[3].id : " + da[3].id + " | parse da[3].title : " + da[3].title);
                //alert();
                //var da1 = JSON.stringify(da[1]);
                //alert('da[1].stringify' + da1)
            },
            error: function(){
                alert("Error!!!")
            }
        })
    })

    /*Function กำหนดค่า Date
    -----------------------*/
    $('#show_date').click(function(){
        var x = $("#date").val()
        vDate = x
        $('#showDate').html(vDate)
    });

    /*Function กำหนดค่า Time
    ----------------------*/
    $('#show_time').click(function () {
        var x = $("#myTime").val()
        vTime = x
        $('#showTime').html(vTime)
    });

    /*Function กำหนดค่า Task
    -----------------------*/
    $('#showTaskList').change(function () {
        var x = $("#showTaskList").val()   //ค่า ID ของ Task

        /*Check Task value
        -------------------
        */
        if(x == '') {
            vTaskid = ''
            $('#showTask').html('---')
            return
        }

        vTaskid = x;
        alert(vTaskid)

        $.ajax({
            type: "POST",
            url: "gettasktitle",
            data: vTaskid,
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (data) {
                dataStr = JSON.stringify(data)
                dataParse = JSON.parse(dataStr)
                vTaskTitle = dataParse[0].title
                $('#showTask').html(vTaskTitle)
            },
            error: function () {
                alert("Error!!!")
            }
        });
    });

    /*Function Save value to DB
    เพื่อเอาเตรียมไว้สร้าง ไฟล์ ical ภายหลัง
    --------------------------------*/
    $('#save_db').click(function() {

        /*------
        Pase

        ------*/

        /*Set Json Data
        -------------*/
        //var appointData = { "DateTime": returnData, "taskId": vTaskid }
        
        var appointD = create_ical(vDate, vTime, vTaskid)
        alert("Data befor send : " + appointD)
        //
        
        $.ajax({
            type: "POST",
            url: "setappoint",
            //data: JSON.stringify(appointData),
            data: appointD,
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (data) {
                /*Clear Show
                
                $('#showDate').html('---')
                $('#showTime').html('---')
                $('#showTask').html('---')
                -------------*/

                /*Clear Data Value
                
                vDate = ''
                vTime = ''
                vTaskTitle = ''
                vTaskid = ''
                vData = ''  
                -------------*/

                /*Clear Input Form
                -------------*/
                $('#date').val('')
                $('#myTime').val('')
                
                alert("Create Success : " + JSON.stringify(data))
            },
            error: function () {
                alert("Error!!!")
            }
        })

        /*Preview Data
        
        alert(  "Data : " + myDate + " | " + 
                "Time : " + myTime + " | " + 
                "TaskId : " + vTaskid + " | " + 
                "TaskTitle : " + vTaskTitle + " | " + 
                "Return DateTime : " + returnData
        );
        ---------------*/        
    });

    $('#create_ical').click(function(){
        
        var appointD = (create_ical(vDate, vTime, vTaskid))
        alert("Data befor send : " + appointD)
        $.ajax({
            type: "POST",
            url: "ical",
            //data: JSON.stringify(appointData),
            data: appointD,
            contentType: "application/json; charset=utf-8",
            //dataType: "binary",
            success: function (data) {
                
                /*Clear Show Data
                -------------*/
                $('#showDate').html('---')
                $('#showTime').html('---')
                $('#showTask').html('---')
                
                /*Clear Data Value
                -------------*/
                vDate = ''
                vTime = ''
                vTaskTitle = ''
                vTaskid = ''
                vData = ''  
                

                /*Clear Input Form
                -------------*/
                $('#date').val('')
                $('#myTime').val('')
                
                //alert(JSON.stringify(data))
                //alert("Create Success : " + data)

                /* Methos DownloadData
                ----------------------*/
                var blob = new Blob([data]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "icalfile.ics";
                link.click();
                
                 
            },
            error: function () {
                alert("Error!!!")
            }
        })
    })
    

</script>

@endsection