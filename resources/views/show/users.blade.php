@extends('layouts.master')

@section('content')
    @include('layouts.admin-menu')

    <div class="row">
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
