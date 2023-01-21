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
                                <th>Вид на гориво</th>
                                <th>Статус</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($cars as $car)
                                <tr>
                                    <td><a href="cars/{{$car->id}}">{{$car->name}}</a></td>
                                    <td>{{$car->registration_number}}</td>
                                    <td>{{$car->gas_type}}</td>
                                    <td>@if ($car->is_active)
                                            Во употреба
                                        @elseif (!$car->is_active)
                                            Не е во употреба
                                        @endif
                                    </td>
                                    <td><a class="btn btn-warning" href="cars/{{$car->id}}/services">Сервиси</a></td>
                                </tr>
                            @endforeach

                            <tr>
                                <form method="POST" action="{{route('addCar')}}">

                                    @csrf
                                    <div>
                                        <td><input placeholder="Модел" name="name" class="form-control"></td>
                                        <td><input placeholder="Број на регистрација" name="registration_number"
                                                   class="form-control"></td>
                                        <td><select name="gas_type" class="form-control" required>
                                                <option value="Бензин">Бензин</option>
                                                <option value="Дизел">Дизел</option>
                                                <option value="Плин">Плин</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="checkbox" name="is_active" value="1">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Додади ново</button>
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
