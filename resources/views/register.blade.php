<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
    <div class="header">
        <nav class="navbar navbar-light bg-light justify-content-between">
            <a class="navbar-brand" href="#">
                <img src="" width="30" height="30" class="d-inline-block align-top" alt="logo">
                <p>Just Du It !</p>
            </a>
            <a href="{{url('/login')}}" style="right: 10px" style = "position: absolute">Login</a>
            <a href="{{url('/login')}}" style="right: 10px" style = "position: absolute">Register</a>
        </nav>

    </div>
    <div class="body">
        <div class="card">
            <h5 class="card-header text-center">Register</h5>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="exampleInputEmail1">Username</label>
                        <input class="form-control form-control-lg" type="text" placeholder="Enter Username">
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputEmail1">Email address</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputPassword1">Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <div class="form-group row">
                        <label for="exampleInputPassword1">Confirm Password</label>
                        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                    </div>
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
