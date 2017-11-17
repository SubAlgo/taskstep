@extends('layouts.template') @section('title', 'Calendar') @section('content')

&nbsp

<div class="ui stacked segment">
    <label for="date">Date</label>
    <input type="text" id="date" placeholder="15/11/2560">
    <span class="ui button primary" name="show_val" id="show_date">Show date Value</span>
     &nbsp
    <label for="time">Time</label>
    <input type="time" id="myTime" value="00:00">
    <span class="ui button primary" name="show_val" id="show_time">Show date Value</span>
</div>

<div class="ui stacked segment">
    <label for="">TaskList</label>

    <select id="showTaskList">
        
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
        <label for="">TaskID:</label>
        <label for="" id="showTask">---</label>
    </p>
    <span class="ui button primary" name="show_all" id="show_all">Show All Value</span>
</div>




<script src="{{elixir('js/glDatePicker.min.js')}}"></script>


<script type="text/javascript">
    var vDate;
    var vTime;
    var vTask;

    $(window).load(function () {
        $('#date').glDatePicker();
        //----Load task
        $.ajax({
            type: "GET",
            url: "gettask",
            dataType: 'json',
            success: function(data){
                var i = 0;
                var myData = JSON.stringify(data);
                alert("data : " + data)
                alert('stringify : ' + myData);
                var da = JSON.parse(myData);
                
                da.forEach(function (element) {
                   //alert(JSON.stringify(element.id) + " | " + JSON.stringify(element.title));
                   $('#showTaskList').append("<option id='opttask' value="+element.id+">"+element.title+"</option>")
                });
                
                //alert("Number of data : " + i);
                //alert("parse da[3].id : " + da[3].id + " | parse da[3].title : " + da[3].title);
                //alert();
                //var da1 = JSON.stringify(da[1]);
                //alert('da[1].stringify' + da1)
            },
            error: function(){
                alert("Error!!!");
            }
        });
    });

    //----- 
    $('#show_date').click(function(){
        var x = $("#date").val();
        vDate = x;
        //alert(x);
        $('#showDate').html(vDate)
    });

    //-----
    $('#show_time').click(function () {
        var x = $("#myTime").val();
        vTime = x;
        $('#showTime').html(vTime)
    });

    //---------------------------

    $('#showTaskList').change(function () {
        var x = $("#showTaskList").val();
        vTask = x;
        $('#showTask').html(vTask)
    });

    //----------------------------

    $('#show_all').click(function() {
        alert("Data : " + vDate + " | " + "Time : " + vTime + " | " + "Task : " + vTask);
    });
    

</script>

@endsection