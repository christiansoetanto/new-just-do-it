@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">Add To Cart</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="..." alt="..." class="img-thumbnail">
                </div>
                <div class="col">
                    <h4>nama</h4>
                    <p>price</p>
                    <p>description:</p>
                    <p>blabla</p>
                    <br>
                    <a>Add to Cart</a>
                    <a>Update Shoe</a>
                </div>
                <div class="col">

                </div>

            </div>
            <div class="form-group row">
                <label for="exampleInputEmail1">Quantity</label>
                <input class="form-control form-control-lg" type="text" placeholder="Quantity">
            </div>
            <button type="submit" class="btn btn-primary">Add To Cart</button>
        </div>


    </div>
@endsection
