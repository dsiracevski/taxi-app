@extends('layouts.master')


@section('content')

    <div class="row">
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9 card card-rounded">
{{--                add service form --}}
                <div class="row">
                    <div class="col-12">
                        <form action="{{route('addService')}}" method="POST">
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
                                    <label for="car_id" class="col-form-label">Тип</label>

                                    <div class="col">
                                        <select name="service_id" id="service_id" class="form-control" required>
                                            @foreach($services as $service)
                                                <option value="{{$service->id}}">{{$service->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="price" class="col-form-label">Цена</label>

                                    <div class="col">
                                        <input type="number" id="price" name="price" class="form-control" required>
                                    </div>
                                </div>

{{--                                <div class="form-group mt-1 mx-2 row">--}}
{{--                                    <label for="km" class="col-form-label">Километри</label>--}}

{{--                                    <div class="col">--}}
{{--                                        <input type="number" id="km" name="km" class="form-control" required>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="form-group mt-1 mx-2 row">
                                    <label for="amount" class="col-form-label">Количина</label>

                                    <div class="col">
                                        <input type="number" id="amount" name="amount" class="form-control" required>
                                    </div>
                                </div>
                                <div class="form-group mt-1 mx-2 row">

                                    <div class="col">
                                        <button type="submit" class="btn btn-primary form-control">Додади</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>


{{--            --}}{{--  add gas form--}}
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <form action="{{route('addFuel')}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group mt-1 mx-2 row">--}}
{{--                                <label for="car_id" class="col-form-label">Возило</label>--}}

{{--                                <div class="col">--}}
{{--                                    <select name="car_id" id="car_id" class="form-control" required>--}}
{{--                                        @foreach($cars as $car)--}}
{{--                                            <option value="{{$car->id}}">{{$car->name}}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}


{{--                            <label for="service_id">--}}
{{--                                <input type="hidden" id="service_id" name="service_id" value="{{$gas->id}}"--}}
{{--                                       required>--}}
{{--                            </label>--}}

{{--                            <div class="form-group mt-1 mx-2 row">--}}
{{--                                <label for="price" class="col-form-label">Цена</label>--}}

{{--                                <div class="col">--}}
{{--                                    <input type="number" id="price" name="price" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group mt-1 mx-2 row">--}}
{{--                                <label for="km" class="col-form-label">Километри</label>--}}

{{--                                <div class="col">--}}
{{--                                    <input type="number" id="km" name="km" class="form-control" required>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="form-group mt-1 mx-2 row">--}}

{{--                                <div class="col">--}}
{{--                                    <button type="submit" class="btn btn-primary form-control">Додади гориво--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </div>
@endsection
