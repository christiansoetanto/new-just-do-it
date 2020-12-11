@extends('master')

@section('content')

<div class="card">
    <h5 class="card-header text-center bg-primary">View all transaction</h5>
    <div class="card-body">

        @if($transactions != 'null')
            @foreach($transactions as $trans)
                <div class="row">
                    <div class="container text-center bg-info m-3 rounded pt-2">
                        <p style="font-size: larger" >{{$trans->transaction_date}} Total: Rp.{{$trans->total_price}}</p>
                    </div>
                    @foreach($trans->detail_transaction as $detail)
                            <img src="{{Storage::url('/uploads/'.$detail->shoe->photo)}}" alt="" class="img-thumbnail" height="300px" width="334px">
                    @endforeach
                </div>

            @endforeach
        @endif


    </div>
</div>
@endsection
