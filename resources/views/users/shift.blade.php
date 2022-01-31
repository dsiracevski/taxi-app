@extends('layouts.master')

@section('content')

    {{--        @dd($cars)--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">

                        {{--                        @dd($withInvoice)--}}
                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th>Возач</th>
                                <th>Поминати километри</th>
                                <th>Основно</th>
                                <th>Чекање</th>
                                <th>Порачка</th>
                                <th>Вкупно</th>
                            </tr>

                            <tbody>
                            @php
                                $endtotal = 0;
                                $net = 0;
                            @endphp
                            @foreach($withNoInvoice as $driver)
                                <tr>
                                    <td>{{$driver->first_name}} {{$driver->last_name}}</td>
                                    <td></td>
                                    <td>@if(!$driver->priceBase)
                                            0 ден.
                                        @else
                                            {{$driver->priceBase}} ден.

                                        @endif</td>
                                    <td>@if(!$driver->priceIdle)
                                            0 ден.
                                        @else
                                            {{$driver->priceIdle}} ден.

                                        @endif</td>
                                    <td>@if(!$driver->priceOrder)
                                            0 ден.
                                        @else
                                            {{$driver->priceOrder}} ден.

                                        @endif</td>
                                    @php
                                        $total = $driver->priceBase + $driver->priceIdle + $driver->priceOrder;
                                        $endtotal  = $endtotal + $total;

                                    @endphp
                                    <td>{{$endtotal}} ден.</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right pr-5 mr-5"><strong>Вкупно:{{$endtotal}}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Invoice Table--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row card-header text-center bg-warning">
                            <div class="col-12">Фактури</div>
                        </div>
                        <table id="myTable2" class="table">
                            <thead>
                            <tr>
                                <th>Возач</th>
                                <th>Основно</th>
                                <th>Чекање</th>
                                <th>Порачка</th>
                                <th>Вкупно</th>
                                <th>Компанија</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $endtotal = 0;
                                $net = 0;
                            @endphp
                            @foreach($withInvoice as $driver)
                                <tr>
                                    <td>{{$driver->first_name}} {{$driver->last_name}}</td>
                                    <td>{{$driver->priceBase}}</td>
                                    <td>{{$driver->priceIdle}}</td>
                                    <td>{{$driver->priceOrder}}</td>
                                    @php
                                        $total = $driver->priceBase + $driver->priceIdle + $driver->priceOrder;
                                    @endphp

                                    <td>{{$total}}</td>
                                    <td>{{$driver->company_name}}</td>
                                    @php
                                        $total = $driver->priceBase + $driver->priceIdle + $driver->priceOrder;
                                        $endtotal  = $endtotal + $total;

                                    @endphp
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right pr-5 mr-5"><strong>Вкупно:{{$endtotal}}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{--Car Table--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="row card-header text-center bg-info">
                            <div class="col-12">Одржување</div>
                        </div>
                        <table id="myTable2" class="table">
                            <thead>
                            <tr>
                                <th>Возило</th>
                                <th>Цена</th>
                                <th>Додадено</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($cars as $car)
                                <tr>
                                    <td>{{$car->name}}</td>

                                    @foreach($car->tServices as $service)
                                        <td>{{$service->serviceSum}}</td>
                                        <td>{{$service->name}}</td>
                                    @endforeach

                                    @php
                                        $total = $service->serviceSum;
                                    @endphp

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right pr-5 mr-5"><strong>Вкупно:{{$total}}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@stop
