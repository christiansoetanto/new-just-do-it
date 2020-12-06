@extends('master')

@section('content')
<h1>View all transaction</h1>

    @foreach($transactions as $trans)
        <div class="row">

        {{$trans->transaction_date}}
        Total: {{$trans->total_price}}
        @foreach($trans->detail_transaction as $detail)
            <div>
                <img src="{{url('/assets/'.$detail->shoe->photo)}}" alt="" class="img-thumbnail">
            </div>
        @endforeach
        </div>

    @endforeach
@endsection
