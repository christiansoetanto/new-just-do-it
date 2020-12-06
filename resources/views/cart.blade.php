@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">View Cart</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="..." alt="..." class="img-thumbnail">
                </div>
                <div class="col">
                    <p>name</p>
                </div>
                <div class="col">
                    <p>quantity</p>
                </div>
                <div class="col">
                    <p>price</p>
                </div>
                <div class="col">
                    <button type="button" class="btn btn-primary">Edit</button>
                </div>

            </div>
            <div class="row">
                <button type="submit" class="btn btn-primary" style="float: right">Check Out</button>
            </div>

        </div>


    </div>
@endsection
