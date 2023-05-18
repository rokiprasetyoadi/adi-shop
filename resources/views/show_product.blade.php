@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Detail Product') }}</div>
                    <div class="row g-0">
                        <div class="col-md-4">
                        <img src="{{ url('storage/' . $product->img) }}" class="img-fluid rounded-start" alt="..." style="width: 100%; height: 100%; object-fit: cover; padding: 10%">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$product->name}}</h5>
                                <p class="card-text">{{$product->desc}}</p>
                                <p class="card-text"><small class="text-body-secondary">Stock : {{$product->stock}}</small></p>
                                <h4>Rp. {{$product->price}}</h4>
                                <p>
                                    @if(Auth::check() && !Auth::user()->is_admin)
                                    <form class="row g-3" action="{{route('add_to_cart', $product)}}" method="post">
                                        @csrf
                                        <div class="col-auto">
                                            <input  type="number" name="amount" value="1">
                                            <button type="submit" class="btn btn-primary" onclick="addToCart()">Add Cart</button>
                                        </div>
                                    </form>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @endif
                </div>
                <div class="card-footer" style="margin-top: 10px; float: right;">
                        <a href="{{route('index_product')}}"><button class="btn btn-primary">Back</button></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection