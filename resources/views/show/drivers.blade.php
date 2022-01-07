@extends('layouts.master')

@section('content')
    @if (Auth::user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif

    <table id="myTable">
        <thead>
        <tr>
            <th>Име</th>
            <th>Презиме</th>
        </tr>
        </thead>

        <tbody>

        @foreach($drivers as $driver)
            <tr>
                <td><a href="drivers/{{$driver->id}}">{{$driver->first_name}}</a></td>
                <td>{{$driver->last_name}}</td>
            </tr>
        @endforeach

        <form method="POST">
            <tr>

                @csrf
                <div>
                    <td><input placeholder="First name" name="first_name"></td>
                    <td><input placeholder="Last Name" name="last_name"></td>
                </div>

                <div>
                    <button type="submit">Add</button>
                </div>
            </tr>
        </form>

        </tbody>
    </table>

    <div>
        <a href="/administration/">Go Back</a>
    </div>

    @stop

    @section('script')
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>
@stop
