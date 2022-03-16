@extends('layouts.master')


@section('content')
    {{--    @dd($bookings)--}}
    <div class="row">
        <div class="col-3">
            <x-menu></x-menu>
        </div>
        <div class="col-9">
            <div class="row mb-3 mt-3">
                <div class="col-4">
                    <a href="javascript:;" data-toggle="modal" data-target="#addRoute"
                       data-driver-id="{{$driverID}}" class="btn btn-primary driver_name">Додади Рута</a>
                </div>
                <div class="col-2">
                    {{$driver->first_name}} {{$driver->last_name}}, смена {{$driver->onWorkCars[0]->pivot->shift}}
                </div>
                <div class="col-3">
                    {{$driver->onWorkCars[0]->name}}, {{$driver->onWorkCars[0]->registration_number}}
                    , {{$driver->onWorkCars[0]->pivot->km}} km
                </div>
                <div class="col-3">
                    {!! $driver->onWorkCars[0]->pivot->note !!}
                </div>
            </div>
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
                <div class="col-12">
                    <div class="card rounded-lg pb-5">
                        <table class="table table-striped directions">
                            <thead>
                            <tr>
                                <td>Час</td>
                                <td>Од - До</td>
                                <td>Цена</td>
                                <td>Чекање</td>
                                <td>Порачка</td>
                                <td>Фактура</td>
                                <td>Вкупно</td>
                                <td>Забелешка</td>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $sum = 0;
                                $invoice = 0;
                                $inSum = 0;
                            @endphp
                            @foreach($directions as $d)
                                <tr class="directions" data-id="{{$d->id}}">
                                    <td>{{$d->created_at->format('H:i')}}
                                        - {{isset($d->updated_at) ? $d->updated_at->format('H:i') : ''}}</td>
                                    <td>{{$d->from_street_name . ' ' . $d->street_number_from}}
                                        - {{$d->to_street_name . ' ' . $d->street_number_to}}
                                        @if($d->return == 1)
                                            <i>Повратна</i>
                                        @endif
                                    </td>
                                    <td>{{$d->price}}</td>
                                    <td>{{$d->price_idle}} </td>
                                    <td>{{$d->price_order}} </td>
                                    <td>{{($d->company_id) ? "Да" : "Не"}} </td>
                                    @php
                                        $totalSum = $d->price + $d->price_idle + $d->price_order;


                                        if(!$d->company_id){
                                            $sum = $sum + $totalSum;
                                        }

                                    if ($d->company_id) {
                                            $invoice = $invoice + $d->price + $totalSum;
                                        }
                                        $inSum = $invoice + $sum;
                                    @endphp
                                    <td>{{$totalSum}}</td>
                                    <td>{{$d->note}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right p-2 border-top">
                            <p><strong>Фактури: {{$invoice}} ден.</strong></p>
                            <p><strong>Вкупно без фактури: {{$sum}} ден.</strong></p>
                            <p><strong>Вкупно со фактури: {{$inSum}} ден.</strong></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



    <!-- The Modal -->
    <div class="modal" id="addRoute">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <div class="row">
                        <div class="col-12">
                            <h4 class="modal-title">Додади рута</h4>
                        </div>
                        <div class="col-6">
                            {{$driver->first_name}} {{$driver->last_name}},
                            смена {{$driver->onWorkCars[0]->pivot->shift}}
                        </div>
                        <div class="col-6">
                            {{$driver->onWorkCars[0]->name}}
                        </div>
                    </div>

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <form action="{{route('storeDirections')}}" method="POST" id="direction">
                        @csrf
                        <input type="hidden" name="driver_id" value="{{$driverID}}" id="driver">
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

                            <input type="hidden" name="car_id" value="{{$driver->onWorkCars[0]->id}}">


                        </div>
                        <div class="row">
                            <div class="form-group col-8">
                                <select class="from_location location form-control" name="location_to_id">
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
                                <input type="number" placeholder="Цена" name="price" class="form-control">
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
                            <div class="col-7 d-flex">
                                <textarea placeholder="Забелешка" class="w-100 form-control" name="note"></textarea>
                            </div>
                            <div class="col-3 d-flex">
                                <label for="return">
                                    <input type="checkbox" name="return" id="return" value="1"> Повратна
                                </label>
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

@section('script')
    <script>
        $(document).ready(function () {
            $(".directions tr").on("click", function () {
                //get id
                let id = $(this).data('id');
                $.ajax({
                    type: 'GET',
                    url: "/directions/single/" + id,
                    success: function (data) {
                        for (item in data.data) {
                            $("[name=" + item).val(data.data[item])
                        }
                        $("#direction").attr('action', '/directions');
                        $("#direction button[type=submit]").html('Зачувај');
                        $('#direction').append('<input type="hidden" name="_method" value="put" />');
                        $('#direction').append('<input type="hidden" name="id" value="' + id + '" />');
                        $("#addRoute").modal();
                        console.log(data.data);
                    },
                    error: function (xhr) {
                        console.log(xhr.responseText);
                    }
                });

            });
            $('#addRoute').on('hidden.bs.modal', function () {
                $('#direction')[0].reset();
                $("[name=id]").remove();
                $("[name=_method]").remove();
            });

            $('#datetimepicker6').datetimepicker({
                lang: 'mk',
                step: 5
            });
        });
    </script>
@stop
