<!DOCTYPE html>
<html lang="en">
<head>
    <title>Calendar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{elixir('css/glDatePicker.default.css')}}"  rel="stylesheet" type="text/css">
 
</head>
<body>
    <input type="text" id="example" />
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="{{elixir('js/glDatePicker.min.js')}}"></script>
    

    <script type="text/javascript">
        $(window).load(function () {
            $('#example').glDatePicker();
        });
    </script>
        
        

        
    </script>
</body>
</html>




