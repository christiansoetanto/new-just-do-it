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
                    <form action="{{route('shoe.update')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$shoe->id}}"/>
                        <input type="number" name="price" value="{{$shoe->price}}"/>
                        <input type="text" name="name" value="{{$shoe->name}}"/>
                        <input type="text" name="description" value="{{$shoe->description}}"/>
                        <button type="submit">submit</button>
                    </form>
                </div>

            </div>

        </div>


    </div>
@endsection
