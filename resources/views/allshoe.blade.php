@extends('master')

@section('content')

    <div class="card">
        <h5 class="card-header text-center">View Shoe</h5>
        <div class="card-body">
            <div class ="row">
            @foreach()
                <div class="col-4">
                    <div class="card-group">
                        <div class="card">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                                <a>
                                    <h5 class="card-title">Card title</h5>
                                </a>
                                <p> price</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

        </div>
    </div>

@endsection
