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
                                <form method="POST">
                                    @csrf
                                    @csrf
                                    <div class="form-group">
                                        <td><input placeholder="Внесете име на улица" name="street_name" class="form-control"></td>
                                        <td><input placeholder="Внесете град" name="city" class="form-control"></td>
                                        <td><input value="Македонија" name="country" class="form-control" hidden></td>
                                    </div>
                                    <div class="form-group">
                                        <td>
                                            <button type="submit" class="btn btn-primary">Додади</button>

                                        </td>
                                    </div>
                                </form>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@endsection
