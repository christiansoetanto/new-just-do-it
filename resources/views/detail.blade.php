@extends('master')

@section('content')
    <div class="row">
        <div class="col">
            <img src="{{url('/assets/'.$shoe->photo)}}" alt="" class="img-thumbnail">
        </div>
        <div class="col">
            <h4>{{$shoe->name}}</h4>
            <p>price: {{$shoe->price}}</p>
            <p>description:{{$shoe->description}}</p>
            @if($auth)
                @if($role == 'member')
                    <a href="{{url('getAddToCart/'.$shoe->id)}}">Add to Cart</a>
                @elseif($role == 'admin')
                    <a href="{{url('getUpdateShoe/'.$shoe->id)}}">Update Shoe</a>
                @endif
            @endif
        </div>
        <div class="col">

        </div>

    </div>
@endsection
