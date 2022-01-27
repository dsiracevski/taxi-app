@extends('layouts.master')


@section('content')

    @if (auth()->user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif

    {{--    gas form--}}
    <div class="row">
                <div class="container-fluid mt-3 col-3">
                    <x-menu></x-menu>
                </div>

        <div class="container-fluid mt-3 col-9">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('addFuel')}}" method="POST">
                        @csrf
                        <div class="card card-rounded">
                            <div class="flex-row mt-1">

                                <label for=car_id"" class="col-3 d-inline">
                                    <p class="d-inline">Возило</p>
                                    <select name="car_id" id="car_id" class="" required>
                                        @foreach($cars as $car)
                                            <option value="{{$car->id}}">{{$car->name}}</option>
                                        @endforeach
                                    </select>
                                </label>
                                <label for="driver_id" class="col-3 d-inline">
                                    <p class="d-inline">Возач</p>
                                    <select name="driver_id" id="driver_id" required>
                                        <option value=""></option>
                                        @foreach($drivers as $driver)
                                            <option
                                                value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                        @endforeach
                                    </select>
                                </label>

                                <label for="service_id">
                                    <input type="hidden" id="service_id" name="service_id" value="{{$gas->id}}"
                                           required>
                                </label>

                                <label for="price" class="col-3 d-inline">
                                    Цена:
                                    <input type="number" id="price" name="price" required>
                                </label>

                                <label for="km" class="col-3 d-inline">
                                    Километри:
                                    <input type="number" id="km" name="km" required>
                                </label>

                                <button type="submit" class="btn btn-primary d-inline">Додади гориво</button>
                            </div>


                        </div>
                    </form>
                </div>
            </div>


            {{--        oil change form--}}
            @if (auth()->user()->is_admin)
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('changeOil')}}" method="POST">
                            @csrf
                            <div class="card card-rounded">
                                <div class="flex-row">

                                    <label for=car_id"" class="col-1 d-inline">
                                        <p class="d-inline">Возило</p>
                                        <select name="car_id" id="car_id" required>
                                            @foreach($cars as $car)
                                                <option value="{{$car->id}}">{{$car->name}}</option>
                                            @endforeach
                                        </select>
                                    </label>
                                    <label for="driver_id" class="col-1 d-inline">
                                        <p class="d-inline">Возач</p>
                                        <select name="driver_id" id="driver_id" required>
                                            <option value=""></option>
                                            @foreach($drivers as $driver)
                                                <option
                                                    value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </label>

                                    <label for="service_id">
                                        <input type="hidden" id="service_id" name="service_id"
                                               value="{{$oil_change->id}}"
                                               required>
                                    </label>

                                    <label for="price" class="col-1 d-inline">
                                        Цена:
                                        <input type="number" id="price" name="price" required>
                                    </label>

                                    <label for="km" class="col-1 d-inline">
                                        Километри:
                                        <input type="number" id="km" name="km" required>
                                    </label>

                                    <button type="submit" class="btn btn-info d-inline">Промена на уље</button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            @endif

        </div>
    </div>


@endsection
