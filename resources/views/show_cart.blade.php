@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Carts') }}</div>

                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                        <p>{{$error}}</p>
                        @endforeach
                    @endif

                    @php
                        $total_price = 0;
                        $sub = 0;
                    @endphp

                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Price</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Subtotal</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($carts as $cart)
                            <tr>
                                <td><img src="{{ url('storage/' . $cart->product->img) }}" alt="" height="100px;"></td>
                                <td>{{ $cart->product->name }}</td>
                                <td>Rp. {{ $cart->product->price }}</td>
                                <td>Rp. {{ $cart->amount }}</td>
                                <td>@php
                                    $sub = $cart->product->price * $cart->amount; 
                                    echo $sub;
                                @endphp
                                </td>
                                <td>
                                <form action="{{route('update_cart', $cart)}}" method="post">
                                    @method('patch')
                                    @csrf
                                    <input type="number" name="amount" value="{{$cart->amount}}" min="0" style="width: 100px;">
                                    <button type="submit" class="btn btn-primary">Up Qty</button>
                                </form>
                                <form action="{{route('delete_cart', $cart)}}" method="post">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                                </td>
                            </tr>
                                @php
                                    $total_price += $cart->product->price * $cart->amount;
                                @endphp
                            @endforeach
                        </tbody>
                    </table>

                <div class="card-footer">
                <p>Total : Rp. {{$total_price}}</p>
                    <form action="{{route('checkout')}}" method="post">
                        @csrf
                        <button type="submit" class="btn btn-warning">Checkout</button>
                    </form>
                </div>
    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection