@extends('master')

@section('content')
    <div class="card">
        <h5 class="card-header text-center">View All Transaction</h5>
        <div class="card-body">
            @foreach()
                <div class="row">
                    <div class="col">
                        <p>datetime</p>
                    </div>
                    <div class="col">
                        <p> Total: </p>
                    </div>
                </div>
                <div class="row">
                    @foreach()
                        <div class="col">
                            <img src="..." alt="..." class="img-thumbnail">
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
@endsection
