<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Just du it</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body>
    <div class="header">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand" href="{{url('/shoe')}}">
                <img src="{{url('/assets/logo.jpg')}}" width="30" height="30" class="d-inline-block align-top" alt="logo">
                <p>Just Du It !</p>
            </a>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            @if($auth)

                <a href="{{url('/logout')}}" style="right: 10px" style = "position: absolute">Logout</a>
            @else
                <a href="{{url('/register')}}" style = "">Register</a>
                <a href="{{url('/login')}}" style = "">Login</a>
            @endif
        </nav>

    </div>
    <div class="body">
        <nav class="navbar navbar-light fixed-left" style="background-color: #e3f2fd;">
            <form class="form-inline">
                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/shoe')}}`">View All Shoe</button>
                @if($auth)
                    @if($role == 'member')
                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewCart')}}`">View Cart</button>
                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewTrans')}}`">View Transaction</button>
                    @elseif($role == 'admin')
                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/')}}`">Add Shoe</button>
                        <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewTrans')}}`">View Transaction</button>

                    @endif
                @endif
            </form>
        </nav>
        <div class="container">
            @yield('content')
        </div>

    </div>
</body>
</html>
