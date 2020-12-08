@extends('master')

@section('content')

    <div class="card">
        <h5 class="card-header text-center">View Shoe</h5>
        <div class="card-body">
            <div class ="row">
                @foreach($shoes as $shoe)
                    <div class="col-4">
                        <div class="card-group">
                            <div class="card">
                                <img
                                    src="{{url('/assets/'.$shoe->photo)}}"
                                    alt="{{$shoe->photo}}"
                                >
                                <div class="card-body">
                                    <a href="{{url('/shoe/'.$shoe->id)}}">
                                        {{$shoe->name}}
                                    </a>
                                    <p> Rp. {{$shoe->price}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>

{{--    @foreach($shoes as $shoe)--}}
{{--        <div>--}}
{{--            <img--}}
{{--                 src="{{url('/assets/'.$shoe->photo)}}"--}}
{{--                 alt="{{$shoe->photo}}"--}}
{{--            >--}}
{{--        </div>--}}
{{--        <a href="{{url('/shoe/'.$shoe->id)}}">--}}
{{--            Name:{{$shoe->name}}--}}
{{--        </a>--}}
{{--        <div>--}}
{{--            Price:{{$shoe->price}}--}}
{{--        </div>--}}
{{--    @endforeach--}}

@endsection
