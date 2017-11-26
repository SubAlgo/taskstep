@extends('layouts.template') @section('title', 'Calendar') @section('content')
&nbsp

<div class="ui stacked segment">
    <label for="">กำหนดการ</label>
    
    <form id="theList" action="/ical/createmulti/">
        <table id="appointTable" border="1">
            <tr>
                <th>Check</th>
                <th>เดือน/วัน/ปี ชั่วโมง:นาที</th>
                <th>Task</th>
            </tr>
        </table>
        
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
        success: function(data) {
        
            var myData = JSON.stringify(data)
            var dataParse = JSON.parse(myData)    

            dataParse.forEach(function (element) {
                $('#appointTable').append("<tr>\
                                            <td align='center'>\
                                                <input type='checkbox' name='list[]' value=" + element.id + ">\
                                            </td>\
                                            <td>" + element.date + "</td>\
                                            <td>" + element.title + "</td>\
                                        </tr>")
            })
            $('#theList').append("<input type='submit' value='Submit'>")
        },
        error: function () {
            alert("Error!!!")
        }
    })
})
    
</script>

@endsection