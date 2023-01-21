@extends('layouts.master')

@section('content')

    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">

                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th>Возач</th>
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
{{--                                @dump($driver)--}}
                                <tr>
                                    <td>{{$driver->first_name}} {{$driver->last_name}}</td>
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
                                    <td>{{$total}} ден.</td>
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


    {{--Services Table--}}
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
                                <th>Сервис</th>
                                <th>Цена</th>
                                <th>Возило</th>
                            </tr>
                            </thead>

                            <tbody>
                            @php
                                $total = 0;
                            @endphp
                            @foreach($services as $service)
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>
                                        @foreach($service->cars as $car)
                                            {{$car->pivot->price}}<br>
                                        @endforeach
                                    </td>

                                    <td>
                                        @foreach($service->cars as $car)
                                            {{$car->name}}<br>
                                        @endforeach
                                    </td>
                                    @php
                                        $total = $total + $car->pivot->price;
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
