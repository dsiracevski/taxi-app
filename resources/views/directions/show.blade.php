@extends('layouts.master')


@section('content')
    <div class="container-fluid mt-3">
        <x-menu></x-menu>
    </div>
    <div class="container-fluid mt-3">
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
        </div>
        <div class="row">
            @foreach($directions as $direction)
                <div class="col-4">
                    <div class="card rounded-lg">
                        <div class="text-center">
                            <a href="javascript:;" class="driver_name" data-toggle="modal" data-target="#addRoute"
                               data-driver-id="{{$direction['driver_id']}}">
                                <h2>{{$direction['driver_first_name']}} {{$direction['driver_last_name']}}</h2>
                            </a>
                            <a href="#"
                               class="shift_driver"
                               data-toggle="modal"
                               data-target="#shiftDriver"
                               data-driver-id="{{$direction['driver_id']}}"
                               data-car-name="{{$direction['car_name']}}"
                               data-car-id="{{$direction['car_id']}}">
                                Zamena</a>
                            <p>{{$direction['car_name']}}</p>
                        </div>
                        <table class="table table-striped ">
                            <thead>
                            <tr>
                                <td width="70">Час</td>
                                <td width="165">Од - До</td>
                                <td width="100">Цена</td>
                                <td>Чек.</td>
                                <td>Пор.</td>
                                <td>Фактура</td>
                                <td>Вкупно</td>
                            </tr>
                            </thead>
                            <tbody>

                            @php
                                $sum = 0;
                            @endphp

                            @foreach($direction['directions'] as $d)
                                <tr class="directions" data-id="{{$d->id}}">
                                    <td>{{$d->created_at->format('H:i')}}</td>
                                    <td>{{$d->from_street_name . ' ' . $d->street_number_from}}
                                        - {{$d->to_street_name . ' ' . $d->street_number_to}}</td>
                                    <td>{{$d->price}} </td>
                                    <td>{{$d->price_idle}} </td>
                                    <td>{{$d->price_order}} </td>
                                    <td>{{($d->invoice) ? "Да" : "Не"}} </td>
                                    @php
                                        $totalSum = $d->price + $d->price_idle + $d->price_order;
                                        if(!$d->invoice){
                                            $sum = $sum + $totalSum;
                                        }
                                    @endphp
                                    <td>{{$totalSum}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right p-2 border-top">
                            <p><strong>Вкупно: {{$sum}} ден.</strong></p>
                        </div>
                    </div>
                    @if(!empty($cars))
                        <div class="col-4">
                            <div class="p-5">
                                @foreach($cars as $car)
                                    <div>{{$car->name}}
                                        <a href="#" class="shift_driver"
                                           data-toggle="modal"
                                           data-target="#shiftDriver"
                                           data-driver-id=""
                                           data-car-name="{{$car->name}}"
                                           data-car-id="{{$car->id}}">
                                            Add
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- The Modal -->
        <div class="modal" id="addRoute">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Додади рута</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('storeDirections')}}" method="POST">
                            @csrf
                            <input type="hidden" name="driver_id" value="" id="driver">
                            <div class="row">
                                <div class="form-group col-8">
                                    <select class="from_location location form-control" name="location_from_id"
                                            required>
                                        <option value=""></option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->street_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" placeholder="Број" name="street_number_from"
                                           class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-8">
                                    <select class="from_location location form-control" name="location_to_id" required>
                                        <option value=""></option>
                                        @foreach($locations as $location)
                                            <option value="{{$location->id}}">{{$location->street_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-4">
                                    <input type="text" placeholder="Број" name="street_number_to" class="form-control">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 d-flex">
                                    <input type="number" placeholder="Цена" required name="price" class="form-control">
                                    <div class="currency-symbol my-auto"> Ден</div>
                                </div>

                                <div class="col-3 d-flex">
                                    <input type="number" placeholder="Чекање" name="price_idle" class="form-control">
                                    <div class="currency-symbol my-auto"> Ден</div>
                                </div>

                                <div class="col-3 d-flex">
                                    <input type="number" placeholder="Порачка" name="price_order" class="form-control">
                                    <div class="currency-symbol my-auto"> Ден</div>
                                </div>
                                <div class="col-3 d-flex">
                                    <select class="company_id company form-control" name="company_id">
                                        <option value="">Компанија</option>
                                        @foreach($companies as $company)
                                            <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                {{--                                <div class="col-3">--}}
                                {{--                                    <label for="invoice"><input type="checkbox" name="invoice" id="invoice" value="1"> Фактура?</label>--}}
                                {{--                                </div>--}}
                            </div>
                            <div class="row mt-3">
                                <div class="col-7">
                                    <textarea placeholder="Забелешка" class="w-100 form-control"></textarea>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-6 text-center">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Откажи</button>
                                </div>
                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-primary">Додади</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>

        <div class="modal" id="shiftDriver">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form action="{{route('assignDriver')}}" method="POST">
                            @csrf
                            <p>Shift driver for car: <span id="carNameToAssign"></span></p>
                            <input type="hidden" value="" name="car" id="carToAssign">
                            <div class="row">
                                <div class="form-group col-8">
                                    <select class="from_location location form-control" name="driver_id" required>
                                        <option value=""></option>
                                        @foreach($allDrivers as $driver)
                                            <option
                                                value="{{$driver->id}}">{{$driver->first_name}} {{$driver->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <textarea placeholder="Note" class="w-100" name="note"></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <input type="number" placeholder="km" class="w-100" name="km" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-center">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>
            </div>
        </div>
@stop
