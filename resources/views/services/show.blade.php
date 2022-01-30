@extends('layouts.master')


@section('content')

    {{--    gas form--}}
    <div class="row">
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9 card card-ronded">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('addFuel')}}" method="POST">
                        @csrf
                        <div class="form-row">
                            <div class="form-group mt-1 mx-2 row">
                                <label for="car_id" class="col-form-label">Возило</label>

                                <div class="col">
                                    <select name="car_id" id="car_id" class="form-control" required>
                                        @foreach($cars as $car)
                                            <option value="{{$car->id}}">{{$car->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group mt-1 mx-2 row">
                                <label for="driver_id" class="col-form-label">Возач</label>

                                <div class="col">
                                    <select name="driver_id" id="driver_id" class="form-control" required>
                                        <option value=""></option>
                                        @foreach($drivers as $driver)
                                            <option
                                                value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <label for="service_id">
                                <input type="hidden" id="service_id" name="service_id" value="{{$gas->id}}"
                                       required>
                            </label>

                            <div class="form-group mt-1 mx-2 row">
                                <label for="price" class="col-form-label">Цена</label>

                                <div class="col">
                                    <input type="number" id="price" name="price" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group mt-1 mx-2 row">
                                <label for="km" class="col-form-label">Километри</label>

                                <div class="col">
                                    <input type="number" id="km" name="km" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group mt-1 mx-2 row">

                                <div class="col">
                                    <button type="submit" class="btn btn-primary form-control">Додади гориво</button>
                                </div>
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
                            <div class="form-row">
                                <div class="form-group mt-1 mx-2 row">
                                    <label for="car_id" class="col-form-label">Возило</label>

                                    <div class="col">
                                        <select name="car_id" id="car_id" class="form-control" required>
                                            @foreach($cars as $car)
                                                <option value="{{$car->id}}">{{$car->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="driver_id" class="col-form-label">Возач</label>

                                    <div class="col">
                                        <select name="driver_id" id="driver_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($drivers as $driver)
                                                <option
                                                    value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <label for="service_id">
                                    <input type="hidden" id="service_id" name="service_id" value="{{$oil_change->id}}"
                                           required>
                                </label>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="price" class="col-form-label">Цена</label>

                                    <div class="col">
                                        <input type="number" id="price" name="price" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="km" class="col-form-label">Километри</label>

                                    <div class="col">
                                        <input type="number" id="km" name="km" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mt-1 mx-2 row">

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary form-control">Промена на уље
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{--        tyre change form--}}

                <div class="row">
                    <div class="col-12">
                        <form action="{{route('changeTyre')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mt-1 mx-2 row">
                                    <label for="car_id" class="col-form-label">Возило</label>

                                    <div class="col">
                                        <select name="car_id" id="car_id" class="form-control" required>
                                            @foreach($cars as $car)
                                                <option value="{{$car->id}}">{{$car->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="driver_id" class="col-form-label">Возач</label>

                                    <div class="col">
                                        <select name="driver_id" id="driver_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($drivers as $driver)
                                                <option
                                                    value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <label for="service_id">
                                    <input type="hidden" id="service_id" name="service_id" value="{{$tyre_change->id}}"
                                           required>
                                </label>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="price" class="col-form-label">Цена</label>

                                    <div class="col">
                                        <input type="number" id="price" name="price" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="km" class="col-form-label">Километри</label>

                                    <div class="col">
                                        <input type="number" id="km" name="km" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mt-1 mx-2 row">

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary form-control">Промена на гуми
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


                {{--        car registration form--}}

                <div class="row">
                    <div class="col-12">
                        <form action="{{route('carRegistration')}}" method="POST">
                            @csrf
                            <div class="form-row">
                                <div class="form-group mt-1 mx-2 row">
                                    <label for="car_id" class="col-form-label">Возило</label>

                                    <div class="col">
                                        <select name="car_id" id="car_id" class="form-control" required>
                                            @foreach($cars as $car)
                                                <option value="{{$car->id}}">{{$car->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="driver_id" class="col-form-label">Возач</label>

                                    <div class="col">
                                        <select name="driver_id" id="driver_id" class="form-control" required>
                                            <option value=""></option>
                                            @foreach($drivers as $driver)
                                                <option
                                                    value="{{$driver->id}}">{{$driver->first_name . ' ' . $driver->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <label for="service_id">
                                    <input type="hidden" id="service_id" name="service_id" value="{{$car_registration->id}}"
                                           required>
                                </label>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="price" class="col-form-label">Цена</label>

                                    <div class="col">
                                        <input type="number" id="price" name="price" class="form-control" required>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="km" class="col-form-label">Километри</label>

                                    <div class="col">
                                        <input type="number" id="km" name="km" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mt-1 mx-2 row">

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary form-control">Регистрација
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
