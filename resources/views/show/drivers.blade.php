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
        </tbody>
    </table>
    <form method="POST">
        <div class="mt-3">
            @csrf
            <div class="flex-row d-flex">
                <td class="d-inline"><input placeholder="First name" name="first_name" class="form-control ml-5"></td>
                <td class="d-inline"><input placeholder="Last Name" name="last_name" class="form-control mx-5"></td>
                <td>
                    <button type="submit" class="btn btn-primary d-inline">Додади</button>
                </td>
            </div>


        </div>
    </form>

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@stop
