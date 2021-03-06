@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center bg-primary">View Cart</h5>
        @if($carts != 'null')
            @foreach($carts as $cart)
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <img src="{{Storage::url('/uploads/'.$cart->shoe->photo)}}" alt="" class="img-thumbnail">
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
                            <button type="button" class="btn btn-primary" onclick="window.location.href='{{url('editCart/'.$cart->shoe->id)}}'">Edit</button>
                        </div>
                    </div>


                </div>
            @endforeach
        @endif
        <div class="row">
            @if($carts != 'null')
                <form action="{{url('checkout')}}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="float: right">Check Out</button>
                </form>
            @endif
        </div>


    </div>
@endsection
