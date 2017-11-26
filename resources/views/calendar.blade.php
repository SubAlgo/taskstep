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
        <option>Pleace select task</option>
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
    <span class="ui button negative" name="clear_value" id="clear_value">Clear</span>
    
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
    เพื่อเอาเตรียมไว้สร้าง ไฟล์ .ics ภายหลัง
    --------------------------------*/
    $('#save_db').click(function() {
        
        var appointD = create_ical(vDate, vTime, vTaskid)
        //alert("Data befor send : " + appointD)
        
        $.ajax({
            type: "POST",
            url: "setappoint",
            //data: JSON.stringify(appointData),
            data: appointD,
            contentType: "application/json; charset=utf-8",
            dataType: 'json',
            success: function (data) {
                var r = confirm("บันทึกข้อมูลสำเร็จ ต้องการเคลียร์ข้อมูลหรือไม่")

                if (r) {
                    clear_data()
                }
                //alert("Create Success : " + JSON.stringify(data))
            },
            error: function () {
                alert("Error!!!")
            }
        })     
    });

    /*Function สร้างไฟล์ .ics
    ----------------------*/
    $('#create_ical').click(function(){
        
        var appointD = (create_ical(vDate, vTime, vTaskid))
        
        $.ajax({
            type: "POST",
            url: "ical",
            data: appointD,
            contentType: "application/json; charset=utf-8",
            //dataType: "binary",
            success: function (data) {

                /* Method DownloadData
                ----------------------*/
                var blob = new Blob([data]);
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = "icalfile.ics";
                link.click();
                

                var r = confirm("สร้างไฟล์ข้อมูลสำเร็จ ต้องการเคลียร์ข้อมูลหรือไม่")

                if (r) {
                    clear_data()
                }
            },
            error: function () {
                alert("Error!!!")
            }
        })
    })

    /*Function Clear value and form
    ------------------------------*/
    $('#clear_value').click(function() {
        clear_data()
        
    });

    /*Function Clear ข้อมูลทั้งหมด
    -------------------------*/
    function clear_data() {
        /*Clear Show
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
    }
    

</script>

@endsection