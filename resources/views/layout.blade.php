<!DOCTYPE html>
<html>
<head>
    <title>CRUD Application</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
</head>
<body>

<div class="container">
    @yield('content')
    @section('toHome')
        <div class="row">
            <div class="col text-center">
                <a class="btn btn-danger" href="{{ route('home') }}">To home</a>
            </div>
        </div>
    @show
</div>

</body>
</html>
