@extends('layouts.master')


@section('content')
    @include('layouts.user-menu')
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
                <div class="col-6">
                    <div class="card rounded-lg col-12">
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
                        <div class="row card-header">
                            <div class="col-2">Час</div>
                            <div class="col-3">Од - До</div>
                            <div class="col-2">Цена</div>
                            <div class="col-3">Ч - П</div>
                            <div class="col-2">Вкупно</div>
                        </div>
                        @php
                            $sum = 0;
                        @endphp
                        @foreach($direction['directions'] as $d)
                            @if ($d->invoice)
                                <div class="row pb-2 pt-2" style="background-color: darkorange">
                                    @else
                                        <div class="row pb-2 pt-2" >
                                            @endif
                                            <div class="col-2">{{$d->created_at->format('H:i')}}</div>
                                            <div class="col-3">{{$d->from_street_name . ' ' . $d->street_number_from}}
                                                - {{$d->to_street_name . ' ' . $d->street_number_to}}</div>
                                            <div class="col-2 text-right">{{$d->price}} ден</div>
                                            <div class="col-3 text-right"><a
                                                    href="directions/{{$d->id}}/idle/">{{$d->price_idle}}
                                                    ден</a> - {{$d->price_order}} ден
                                            </div>
                                            @php
                                                $totalSum = $d->price + $d->price_idle + $d->price_order;
                                                $sum = $sum + $totalSum;
                                            @endphp
                                            <div class="col-2 text-right">{{$totalSum}} ден</div>
                                        </div>
                                        @endforeach
                                        <div class="row card-footer">
                                            <div class="col-10">Vkupno</div>
                                            <div class="col-2 text-right">{{$sum}} ден</div>
                                        </div>
                                </div>
                    </div>
                    @endforeach
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
        </div>


        <!-- The Modal -->
        <div class="modal" id="addRoute">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Modal Heading</h4>
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
                                    <input type="text" placeholder="Broj na ulica" name="street_number_from">
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
                                    <input type="text" placeholder="Broj na ulica" name="street_number_to">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <input type="number" placeholder="Cena" required name="price">
                                </div>

                                <div class="col-4">
                                    <input type="number" placeholder="Cekanje" name="price_idle">
                                </div>

                                <div class="col-4">
                                    <input type="number" placeholder="Porachka" name="price_order">
                                </div>

                                <div class="col-7">
                                    <textarea placeholder="Note" class="w-100"></textarea>
                                </div>

                                <div class="col-1">
                                    <label for="invoice">Invoice?</label>
                                    <input type="hidden" value="0" name="invoice">
                                    <input type="checkbox" value="1" name="invoice">
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
                                <div class="form-group col-8"   >
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

        @section('script')
            <script>
                $(document).ready(function () {
                    $("a.driver_name").on('click', function (e) {
                        e.preventDefault();
                        let driver_id = $(this).attr('data-driver-id');
                        $('#driver').val(driver_id);
                    })


                    $('.from_location').select2({
                        placeholder: 'Select from location',
                        theme: "bootstrap"
                    });

                    $('.to_location').select2({
                        placeholder: 'Select to location',
                        theme: "bootstrap"
                    });
                    /**
                     * autoclose alert
                     */
                    $(".alert").delay(4000).slideUp(200, function () {
                        $(this).alert('close');
                    });


                    $("a.shift_driver").on('click', function (e) {
                        e.preventDefault();
                        let car_id = $(this).attr('data-car-id');
                        let car_name = $(this).attr('data-car-name');
                        let driver_id = $(this).attr('data-driver-id');
                        $('#carToAssign').val(car_id);
                        $('#carNameToAssign').html(car_name);
                    })
                });
            </script>
@stop
