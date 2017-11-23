@extends('layouts.template') @section('title', 'Calendar') @section('content')
&nbsp

<div class="ui stacked segment">
    <label for="">กำหนดการ</label>
    <form id="theList" action="">
        
    </form>
</div>

<script type="text/javascript">

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
})

$(window).load(function(){
     $.ajax({
        type: "GET",
        url: "getappoint",
        dataType: 'json',
        success: function (data) {
           
            var i = 0;
            var myData = JSON.stringify(data)
            var dataParse = JSON.parse(myData)
            vData = dataParse
            dataParse.forEach(function (element) {
                $('#theList').append("<input type='checkbox' name='appointlist' id='appointlist' value=" + element.id + ">" + element.date + '<br>')
            });
            $('#theList').append("<input type='submit' value='Submit'>")
            
            
            
            //alert(JSON.stringify(data))
        },
        error: function () {
            alert("Error!!!")
        }
    })
})
    
</script>

@endsection