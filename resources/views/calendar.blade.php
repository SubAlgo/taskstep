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
    <select>
        <option value="volvo">Volvo</option>
        <option value="saab">Saab</option>
        <option value="opel">Opel</option>
        <option value="audi">Audi</option>
    </select>

</div>




<script src="{{elixir('js/glDatePicker.min.js')}}"></script>


<script type="text/javascript">
    var vHour;
    var vTime;
    var TaskList;

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
                i = (data).length;
                w = 0;
                da.forEach(function (element) {
                   alert(JSON.stringify(element.id) + " | " + JSON.stringify(element.title));
                   
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
        alert(x);
    });

    //-----
    $('#show_time').click(function () {
        var x = $("#myTime").val();
        alert(x);
    });

    //---------------------------
    

</script>

@endsection