@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger fade in alert-dismissible show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-{{session('message')['type']}} fade in alert-dismissible show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {{session('message')['text']}}
                </div>
            @endif
        </div>
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
                                <th></th>
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

                            <tr>
                                <form method="POST" action="{{route('addCar')}}">

                                    @csrf
                                    <div>
                                        <td><input placeholder="Кола" name="name" class="form-control"></td>
                                        <td><input placeholder="Број на регистрација" name="registration_number"
                                                   class="form-control"></td>
                                        <td>
                                            <input type="hidden" name="is_active" value="0" hidden>
                                            <label for="check">Во употреба?</label>
                                            <input name="is_active" value="1" type="checkbox" class="mr-2" id="check">
                                        </td>
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
        </div>
    </div>

@endsection
