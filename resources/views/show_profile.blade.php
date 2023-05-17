@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('All Product') }}</div>
                <div class="card-body">
                    1. Detail
                    <table class="table" style="width: 30%">
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{$user->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{$user->email}}</td>
                        </tr>
                        <tr>
                            <td>Role</td>
                            <td>:</td>
                            <td>{{$user->is_admin ? 'Admin' : 'Member'}}</td>
                        </tr>
                    </table>

                    @if ($errors->any)
                        @foreach ($errors->all() as $error)
                            <p>{{$error}}</p>
                        @endforeach
                    @endif

                    <hr>

                    2. Edit Data
                    <form class="row g-3" action="{{route('edit_profile')}}" method="post">
                        @csrf
                        <div class="col-12">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}" placeholder="name">
                        </div>

                        <div class="col-md-6">
                            <label for="inputEmail4" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="col-md-6">
                            <label for="inputPassword4" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation">
                        </div>
                        

                        <button type="submit" class="btn btn-primary">Change Profile</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection