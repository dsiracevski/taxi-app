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
            <th>Email</th>
            <th>Администратор?</th>

        </tr>
        </thead>

        <tbody>

        @foreach($users as $user)
            <tr>
                <td><a href="users/{{$user->id}}">{{$user->full_name}}</a></td>

                <td>{{$user->email}}</td>
                @if($user->is_admin)
                    <td>Da</td>
                @elseif(!$user->is_admin)
                    <td>Ne</td>
                @endif
            </tr>
        @endforeach
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
