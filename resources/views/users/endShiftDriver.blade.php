@extends('layouts.master')


@section('content')

    <div class="row">
        <div class="col-3">
            <x-menu></x-menu>
        </div>
        <div class="col-9">
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
            @foreach($drivers as $driver)
                <div class="row mb-3">
                    <div class="col-2">{{$driver->first_name}} {{$driver->first_name}}</div>
                    <div class="col-4">
                        <form method="post" action="{{route('endShiftForDriver')}}" class="end_shift form-inline">
                            @csrf
                            <div class="form-group">
                                <input type="number" min="1" value="" name="km" placeholder="Километри" required
                                       autocomplete="off" class="form-control">
                                <input type="hidden" value="{{$driver->id}}" name="driver_id">
                                <input type="hidden" value="{{$driver->onWorkCars[0]->pivot->id}}" name="id">
                            </div>
                                <button type="submit" class="btn btn-primary mx-3">Заврши смена</button>

                        </form>
                    </div>
                </div>
            @endforeach
            <div class="row">
                @if($cars->isNotEmpty())
                    <div class="col-12"><h3>Додади смена</h3></div>
                    <div class="col-12">
                        <h4>Слободни коли:</h4>
                    </div>
                    <div class="col-12">
                        <ul>
                            @foreach($cars as $car)
                                <li>{{$car->name}}
                                    <a href="#" class="shift_driver"
                                       data-toggle="modal"
                                       data-target="#shiftDriver"
                                       data-driver-id=""
                                       data-car-name="{{$car->name}}"
                                       data-car-id="{{$car->id}}">
                                        Додади
                                    </a></li>
                            @endforeach
                        </ul>
                    </div>
                @else
                    <div class="col-12"><h3>Нема слободни коли</h3></div>
                @endif
            </div>
        </div>
    </div>


    <!-- The Modal -->
    <div class="modal" id="shiftDriver">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Додади смена</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('assignDriver')}}" method="POST">
                        @csrf
                        <p>Кола: <strong id="carNameToAssign"></strong></p>
                        <input type="hidden" value="" name="car" id="carToAssign">
                        <div class="row">
                            <div class="form-group col-8">
                                <select class="from_location location form-control" name="driver_id" required>
                                    <option value=""></option>
                                    @foreach($allAvilibledrivers as $driver)
                                        <option
                                            value="{{$driver->id}}">{{$driver->first_name}} {{$driver->last_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="shift_1"> Смена 1
                                    <input type="radio" name="shift" value="1" id="shift_1" checked>
                                </label>
                                <label for="shift_2"> Смена 2
                                    <input type="radio" name="shift" value="2" id="shift_2">
                                </label>
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
            $("form.end_shift").on('submit', function (e) {
                // e.preventDefault();
                // return window.confirm("Дали си сигурен?");

            })

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
            });

            $(".directions tr").on("click", function () {
                //get id
                let id = $(this).data('id');
            })
        });
    </script>
@stop
