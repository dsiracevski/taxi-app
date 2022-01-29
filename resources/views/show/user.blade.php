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

                        <table class="table">

                            <thead>
                            <tr>
                                <th>Име</th>
                                <th>Презиме</th>
                                <th>Email</th>
                                <th>Админстратор?</th>

                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                <form method="POST" action="{{route('editUser', $user->id)}}">
                                    @csrf
                                    @method('PUT')
                                    <td><input value="{{$user->first_name}}" name="first_name" class="form-control"></td>
                                    <td><input value="{{ $user->last_name }}" name="last_name" class="form-control"></td>
                                    <td><input value="{{ $user->email }}" name="email" class="form-control"></td>
                                    <input name="id" value="{{$user->id}}" hidden>
                                    <input type="hidden" name="is_admin" value="0">
                                    <td><input name="is_admin" type="checkbox"
                                               {{$user->is_admin ? 'checked' : ''}} value="1"></td>
                                    <td class="d-flex justify-content-center">
                                        <button type="submit" class="btn btn-primary d-inline">Промени</button>
                                    </td>
                                </form>

                                <form method="POST" action="{{route('deleteUser', $user->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <button type="submit" class="btn btn-danger d-inline">Избриши</button>
                                    </td>
                                </form>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>




@endsection
