@extends('master')

@section('content')

    <div class="card">
        <h5 class="card-header text-center bg-primary">View Shoe</h5>
        <div class="card-body">
            <div class ="row">
                @foreach($shoes as $shoe)
                    <div class="col-4">
                        <div class="card-group">
                            <div class="card">
                                <img
                                    src="{{Storage::url('/uploads/'.$shoe->photo)}}"
                                    alt="{{$shoe->photo}}" height="300px" width="334px"
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
            {{$shoes->links()}}

        </div>
    </div>


@endsection
