@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">Add Shoe</h5>
        <div class="card-body">
            <form>
                <div class="form-group row">
                    <label for="exampleInputEmail1">Shoe Name</label>
                    <input class="form-control form-control-lg" type="text" placeholder="Enter Shoe Name">
                </div>
                <div class="form-group row">
                    <label for="exampleInputEmail1">Price</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Price">
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword1">Description</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Description">
                </div>
                <div class="form-group row">
                    <label for="exampleInputPassword1">Confirm Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Confirm Password">
                </div>
                <button type="submit" class="btn btn-primary">Add Shoe</button>
            </form>
        </div>
    </div>
@endsection
