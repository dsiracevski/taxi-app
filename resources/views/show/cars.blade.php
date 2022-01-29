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
                                <th>Возило</th>
                                <th>Број на регистрација</th>
                                <th>Статус</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($cars as $car)
                                <tr>
                                    <td><a href="cars/{{$car->id}}">{{$car->name}}</a></td>
                                    <td>{{$car->registration_number}}</td>
                                    <td>@if ($car->is_active)
                                            Во употреба
                                        @elseif (!$car->is_active)
                                            Не е во употреба
                                        @endif</td>
                                </tr>
                            @endforeach

                            <form method="POST">
                                <tr>

                                    @csrf
                                    <div>
                                        <td><input placeholder="Кола" name="name" class="form-control"></td>
                                        <td><input placeholder="Број на регистрација" name="registration_number" class="form-control"></td>
                                        <td><input name="is_active" value="1" type="checkbox" class="mr-2">Во употреба?</td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Додади</button>
                                        </td>

                                    </div>

                                </tr>
                            </form>

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
