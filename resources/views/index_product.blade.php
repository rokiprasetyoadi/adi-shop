@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Product') }}</div>

                <div class="card-body">
                    @if(Auth::user()->is_admin)
                        <a href="{{route('create_product')}}"><button class="btn btn-primary" style="margin-bottom: 15px;">Add Product</button></a>
                    @endif

                    <div class="row row-cols-1 row-cols-md-3 g-4">
                    @foreach ($products as $data)
                        <div class="col">
                            <div class="card h-100">
                                <img src="{{ url('storage/' . $data->img) }}" class="card-img-top" alt="..." style="width: 100%; height: 100%; object-fit: cover; padding: 10%">
                                <div class="card-body">
                                    <h5 class="card-title">{{$data->name}}</h5>
                                    <p class="card-text" >{{$data->desc}}</p>
                                    <div class="text-center">
                                        <p>Stock : {{$data->stock}} | Rp.{{$data->price}}</p>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                        @if(!Auth::user()->is_admin)
                                        <form action="{{route('add_to_cart', $data)}}" method="post">
                                            @csrf
                                            <input type="number" name="amount" value="1">
                                            <button type="submit" onclick="addToCart()" class="btn btn-primary">Add Cart</button>
                                        </form>
                                        @endif

                                        <form action="{{route('show_product', $data)}}" method="get">
                                            @csrf
                                            <button type="submit" class="btn btn-info">Detail</button>
                                        </form>

                                        @if(Auth::user()->is_admin)
                                        <form action="{{route('edit_product', $data)}}" method="get">
                                            @csrf
                                            <button class="btn btn-secondary" type="submit">Edit</button>
                                        </form>
                                        <form action="{{route('delete_product', $data)}}" method="post">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Delete</button>
                                        </form>
                                        @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                    <br>
                    {{$products->links('pagination::bootstrap-5')}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection