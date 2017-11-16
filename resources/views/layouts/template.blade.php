<html>

<head>
    @section('script')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.2.13/semantic.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <link href="{{elixir('css/glDatePicker.default.css')}}" rel="stylesheet" type="text/css">
    <link href="{{elixir('css/glDatePicker.darkneon.css')}}" rel="stylesheet" type="text/css">
    <link href="{{elixir('css/glDatePicker.flatwhite.css')}}" rel="stylesheet" type="text/css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    @show
    

    <title>@yield('title')</title>
</head>

<body>
    <!-- NevBar -->
    <div>
        @section('sidebar') @include('layouts.nevbar') @show
    </div>

    <!-- Content -->
    <div class="ui text container">
        @yield('content')
    </div>

</body>

</html>