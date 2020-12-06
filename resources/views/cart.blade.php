@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">View Cart</h5>
        @foreach($carts as $cart)
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <img src="{{url('/assets/'.$cart->shoe->photo)}}" alt="" class="img-thumbnail">
                    </div>
                    <div class="col">
                        <p>{{$cart->shoe->name}}</p>
                    </div>
                    <div class="col">
                        <p>{{$cart->quantity}}</p>
                    </div>
                    <div class="col">
                        <p>{{$cart->quantity * $cart->shoe->price}}</p>
                    </div>
                    <div class="col">
                        <button type="button" class="btn btn-primary" onclick="window.location.href='{{url('editCart/'.$cart->id)}}'">Edit</button>
                    </div>

                </div>


            </div>

        @endforeach
        <div class="row">
            <form action="{{url('checkout')}}" method="post">
                @csrf
                <button type="submit" class="btn btn-primary" style="float: right">Check Out</button>
            </form>
        </div>


    </div>
@endsection
