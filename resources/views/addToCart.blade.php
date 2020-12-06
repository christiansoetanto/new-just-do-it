@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">Add To Cart</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="{{url('/assets/'.$shoe->photo)}}" alt="" class="img-thumbnail">
                </div>
                <div class="col">
                    <h4>{{$shoe->name}}</h4>
                    <p>price: {{$shoe->price}}</p>
                    <p>description:{{$shoe->description}}</p>
                </div>

            </div>
            <form action="{{route('cart.add')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$shoe->id}}"/>
                <input type="number" name="quantity"/>
                <button type="submit">submit</button>
            </form>
        </div>


    </div>
@endsection
