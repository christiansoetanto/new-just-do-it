@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center bg-primary">Add To Cart</h5>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <img src="{{Storage::url('/uploads/'.$shoe->photo)}}" alt="" class="img-thumbnail">
                </div>
                <div class="col">
                    <h4>{{$shoe->name}}</h4>
                    <p>Price: {{$shoe->price}}</p>
                    <p>Description:{{$shoe->description}}</p>
                </div>

            </div>
            <form action="{{route('cart.add')}}" method="post">
                @csrf
                <input type="hidden" name="id" value="{{$shoe->id}}"/>
                <input type="number" name="quantity"/>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>


    </div>
@endsection
