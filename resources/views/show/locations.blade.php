@extends('layouts.master')

@section('content')
    @if (Auth::user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif
    <form method="POST">
        @csrf
        <table id="myTable">
            <thead>
            <tr>
                <th>Улица</th>
                <th>Град</th>
                <th>Држава</th>
            </tr>
            </thead>

            <tbody>

            @foreach($locations as $location)
                <tr>
                    <td><a href="locations/{{$location->id}}">{{$location->street_name}}</a></td>
                    <td>{{$location->city}}</td>
                    <td>{{$location->country}}</td>
                </tr>
            @endforeach


            <tr>

                @csrf
                <div>
                    <td><input placeholder="Внесете име на улица" name="street_name"></td>
                    <td><input placeholder="Внесете град" name="city"></td>
                    <td><input placeholder="Внесете држава" name="country"></td>
                </div>

            </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Додади</button>
        </div>
    </form>

    <div>
        <a href="/administration/">Назад</a>
    </div>

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@stop
