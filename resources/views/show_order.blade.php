@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>
                <div class="card-body">
                    @php
                        $total_price = 0;
                        $sum = 0;
                        $i=1;
                    @endphp

                    <p>ID : {{$order->id}}</p>
                    <p>USER : {{$order->user->name}}</p>
                    <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->transactions as $data)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data->product->name}}</td>
                            <td>{{$data->product->price}}</td>
                            <td>{{$data->amount}}</td>
                            <td>
                            @php
                                $sum = $data->product->price * $data->amount;
                                echo "Rp. " . $sum;
                            @endphp
                            </td>
                        </tr>
                            @php
                                $total_price += $data->product->price * $data->amount;
                            @endphp
                        @endforeach
                        <tr>
                            <td colspan="4">Total</td>
                            <td>Rp. {{$total_price}}</td>
                        </tr>
                    </tbody>
                    </table>
                    @if(!Auth::user()->is_admin)
                        @if ($order->is_paid == false && $order->payment_receipt == null)
                        <form class="row g-3" action="{{route('submit_payment_receipt', $order)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <label for="payment_receipt">Upload Your Payment</label><br>
                                <input type="file" name="payment_receipt" id="payment_receipt"><br>
                            </div>

                            <button type="submit" class="btn btn-primary">Confirm Payment</button>
                        </form>

                        @else
                        <label>Payment Receipt Uploaded</label>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection