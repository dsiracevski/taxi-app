@extends('layouts.master')

@section('content')
    @if (Auth::user()->is_admin)
        @include('layouts.admin-menu')
    @endif

    <div class="row">
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9">
            <div class="row">
                <div class="col-12">
                    <div class="card card-rounded">
                        <table class="table ">
                            <thead>
                            <tr>
                                <th>Улица</th>
                                <th>Град</th>
                                <th>Држава</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                <form method="POST" action="{{route('updateLocation', ['location' => $location->id])}}">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-row">
                                        <div class="form-group">
                                            <td><input value="{{ $location->street_name }}" name="street_name"></td>
                                            <td><input value="{{ $location->city }}" name="city"></td>
                                            <td><input value="{{ $location->country }}" name="country"></td>
                                        </div>
                                        <div class="form-group">
                                            <td>
                                                <button type="submit" class="btn btn-primary d-inline">Промени</button>

                                            </td>
                                        </div>
                                    </div>

                                </form>

                                <form method="POST" action="{{route('deleteLocation', ['location' => $location->id])}}">
                                    @csrf
                                    @method('DELETE')
                                    <div class="form-group">
                                        <td>
                                            <button type="submit" class="btn btn-danger">Избриши</button>
                                        </td>
                                    </div>
                                </form>
                            </tr>

                            </tbody>
                        </table>

                        @stop

                        @section('script')
                            <script>
                                $(document).ready(function () {
                                    $('#myTable').DataTable();
                                });
                            </script>
@stop
