@extends('layouts.master')

@section('content')
    @include('layouts.user-menu')
    {{--        @dd($drivers)--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
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
                            @endphp
                            @foreach($withNoInvoice as $driver)
                                <tr>
                                        <td>{{$driver->first_name}} {{$driver->last_name}}</td>
                                        <td></td>
                                        <td>{{$driver->priceBase}}</td>
                                        <td>{{$driver->priceIdle}}</td>
                                        <td>{{$driver->priceOrder}}</td>
                                        @php
                                            $total = $driver->priceBase + $driver->priceIdle + $driver->priceOrder;
                                            $endtotal  = $endtotal + $total;
                                        @endphp
                                        <td>{{$total}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-right pr-5 mr-5"><strong>Вкупно: {{$endtotal}}</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')

@stop
