@extends('layouts.master')

@section('content')
    @if (Auth::user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif
    <div>
        <form method="POST">
            @csrf
            @method('PATCH')
            <table id="myTable">
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
                    <div>
                        <td><input value="{{ $user->first_name }}" name="first_name"></td>
                        <td><input value="{{ $user->last_name }}" name="last_name"></td>
                        <td><input value="{{ $user->email }}" name="email"></td>
                        <input type="hidden" name="is_admin" value="0">
                        <td><input name="is_admin" type="checkbox" {{$user->is_admin ? 'checked' : ''}} value="1"></td>
                    </div>
                </tr>
                </tbody>
            </table>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary d-inline">Промени</button>
            </div>
        </form>

        <div class="d-inline">
            <a href="/administration/" class="d-inline">Назад</a>
            <form method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger d-inline">Избриши</button>
            </form>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@stop
