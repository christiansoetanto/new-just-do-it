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
        <nav class="navbar navbar-light justify-content-between" style="background-color: #e3f2fd;" >
            <a class="navbar-brand" href="{{url('/shoe')}}">
                <img src="{{Storage::url('/uploads/logo.jpg')}}" width="30" height="30" class="d-inline-block align-top" alt="logo">
                Just Du It !
            </a>
            <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search" value="{{Request::input('search')}}">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <span class="navbar-text">
            @if($auth)
                <form action="{{route('logout')}}" method = "post">
                    @csrf
                    <button class="btn btn-secondary" type="submit">Logout</button>
                </form>
                @else
                    <button class="btn btn-secondary" type="button" onclick="window.location.href='{{url('/register')}}'">Register</button>
                    <button class="btn btn-secondary" type="button" onclick="window.location.href='{{url('/login')}}'">Login</button>
{{--                    <a href="{{url('/register')}}" style = "">Register</a>--}}
{{--                    <a href="{{url('/login')}}" style = "">Login</a>--}}
                @endif
            </span>
        </nav>
    </div>


    <div class="body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-3 px-1 bg-light position-fixed" id="sticky-sidebar">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/shoe')}}`">View All Shoe</button>
                        </li>
                        @if($auth)
                            @if($role == 'member')
                                <li class="nav-item active">
                                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewCart')}}`">View Cart</button>

                                </li>
                                <li class="nav-item active">
                                <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewTrans')}}`">View Transaction</button>

                                </li>
                            @elseif($role == 'admin')
                                <li class="nav-item active">

                                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/addShoe')}}`">Add Shoe</button>
                                </li>
                                <li class="nav-item active">

                                    <button class="btn btn-sm btn-outline-secondary" type="button" onclick="window.location.href = `{{url('/viewTrans')}}`">View Transaction</button>
                                </li>

                            @endif
                        @endif
                    </ul>
                </div>
                <div class="col offset-3" id="main">
                    @yield('content')
                </div>
            </div>
        </div>

    </div>
</body>
</html>
