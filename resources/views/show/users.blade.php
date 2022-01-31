@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger fade in alert-dismissible show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-{{session('message')['type']}} fade in alert-dismissible show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {{session('message')['text']}}
                </div>
            @endif
        </div>
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9">
            <div class="row">
                <div class="col-12">
                    <div class="card card-rounded">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Име</th>
                                <th>Email</th>
                                <th>Улога</th>

                            </tr>
                            </thead>

                            <tbody>

                            @foreach($users as $user)
                                <tr>
                                    <td><a href="users/{{$user->id}}">{{$user->full_name}}</a></td>

                                    <td>{{$user->email}}</td>
                                    @if($user->is_admin)
                                        <td>Администратор</td>
                                    @elseif(!$user->is_admin)
                                        <td>Диспечер</td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@endsection
