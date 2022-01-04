@extends('layouts.master')


@section('content')

    @if (auth()->user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif

    {{--    @dd($cars)--}}


    {{--    gas form--}}
    <div class="card">
        <div class="card-body">
            <form action="{{route('addFuel')}}" method="POST">
                @csrf
                <div class="block mx-3">
                    <div class="text-left col-12 d-inline">

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
                            <input type="hidden" id="service_id" name="service_id" value="{{$gas->id}}" required>
                        </label>

                        <label for="price" class="col-1 d-inline">
                            Цена:
                            <input type="number" id="price" name="price" required>
                        </label>

                        <label for="km" class="col-1 d-inline">
                            Километри:
                            <input type="number" id="km" name="km" required>
                        </label>
                    </div>

                    <button type="submit" class="btn btn-primary d-inline">Додади гориво</button>

                </div>
            </form>
        </div>


        {{--        oil change form--}}
        @if (auth()->user()->is_admin)
            <div class="card-body">
                <form action="{{route('changeOil')}}" method="POST">
                    @csrf
                    <div class="block mx-3">
                        <div class="text-left col-12 d-inline">

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
                                <input type="hidden" id="service_id" name="service_id" value="{{$oil_change->id}}"
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
                        </div>

                        <button type="submit" class="btn btn-info d-inline">Промена на уље</button>

                    </div>
                </form>
            </div>
        @endif


        <div class="card-body">
            <a href="{{url()->previous()}}" class="btn btn-danger">Врати се назад</a>
        </div>

    </div>


@endsection
