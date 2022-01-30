@extends('layouts.master')

@section('content')
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
                                        <td><input placeholder="Име" name="first_name"
                                                   class="form-control">
                                        </td>
                                        <td><input placeholder="Презиме" name="last_name"
                                                   class="form-control"></td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Додади нов</button>
                                        </td>
                                    </div>


                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@stop

