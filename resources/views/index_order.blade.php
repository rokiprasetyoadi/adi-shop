@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Orders') }}</div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th scope="col">Receipt</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>
                                    @if($order->is_paid == true)
                                        Paid
                                    @else
                                        Unpaid
                                    @endif
                                </td>
                                <td>
                                    @if ($order->payment_receipt)
                                        <a href="{{url('storage/' . $order->payment_receipt)}}">Show Payment Receipt</a>
                                    @endif
                                </td>
                                <td><a href="{{route('show_order', $order)}}"><button class="btn btn-info">Detail</button></a></td>
                                <td>
                                @if($order->is_paid == false)
                                    @if(Auth::user()->is_admin)
                                        <form action="{{route('confirm_payment', $order)}}" method="post">
                                            @csrf
                                            <button class="btn btn-primary" type="submit">Confirm</button>
                                        </form>
                                    @endif
                                @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection