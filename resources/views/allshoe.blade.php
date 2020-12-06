@extends('master')

@section('content')
    @foreach($shoes as $shoe)
        <div>
            <img
                 src="{{url('/assets/'.$shoe->photo)}}"
                 alt="{{$shoe->photo}}"
            >
        </div>
        <a href="{{url('/shoe/'.$shoe->id)}}">
            Name:{{$shoe->name}}
        </a>
        <div>
            Price:{{$shoe->price}}
        </div>
    @endforeach

@endsection
