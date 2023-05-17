@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Add Product') }}</div>
                <div class="card-body">
                    @if ($errors->any)
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @endif
                    <form class="row g-3" action="{{route('store_product')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Name">
                        </div>
                        <div class="col-12">
                            <label for="desc" class="form-label">Desc</label>
                            <textarea name="desc" class="form-control" id="desc" placeholder="Description"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label for="stock" class="form-label">Stock</label>
                            <input type="number" name="stock" class="form-control" id="stock" value="1" min="1">
                        </div>
                        <div class="col-md-6">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" class="form-control" id="price" value="1" min="1">
                        </div>
                        <div class="col-12">
                            <label for="img" class="form-label">Image</label>
                            <input type="file" name="img" class="form-control" id="img">
                        </div>
                            
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Submit Data</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection