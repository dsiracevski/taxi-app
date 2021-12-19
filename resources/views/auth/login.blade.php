@extends('layouts.master')

@section('content')
    <div class="row justify-content-center align-items-center " style="height:100vh">
        <div class="col-md-6 login-form">
            <div class="card p-5 shadow bg-white rounded">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{route('loginStore')}}" autocomplete="off" method="POST">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="Username/E-mail">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" id="sendlogin" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
