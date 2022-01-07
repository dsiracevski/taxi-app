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
                    <th>Улица</th>
                    <th>Град</th>
                    <th>Држава</th>
                </tr>
                </thead>

                <tbody>

                <tr>
                    <div>
                        <td><input value="{{ $location->street_name }}" name="street_name"></td>
                        <td><input value="{{ $location->city }}" name="city"></td>
                        <td><input value="{{ $location->country }}" name="country"></td>
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

        @stop

        @section('script')
            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable();
                });
            </script>
@stop
