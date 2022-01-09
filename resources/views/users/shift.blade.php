@extends('layouts.master')

@section('content')
    @include('layouts.user-menu')
    {{--        @dd($drivers)--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card rounded-lg col-12">
                            <div class="row card-header">
                                <div class="col-2">Возач</div>
                                <div class="col-2">Поминати километри</div>
                                <div class="col-2">Основно</div>
                                <div class="col-2">Чекање</div>
                                <div class="col-2">Порачка</div>
                                <div class="col-2">Вкупно</div>
                            </div>


                            @foreach($drivers as $driver)
                                <div class="row pb-2 pt-2 ">
                                    <div class="col-2">{{$driver->full_name}}</div>
                                    @foreach($driver->cars as $car)
                                        <div class="col-2">{{$car->pivot->km}}</div>
                                    @endforeach
                                    <div class="col-2">{{$driver->tDirections->sum('price')}}</div>
                                    <div class="col-2">{{$driver->tDirections->sum('price_idle')}}</div>
                                    <div class="col-2">{{$driver->tDirections->sum('price_order')}}</div>


                                    @php
                                        $total = $driver->tDirections->sum('price') + $driver->tDirections->sum('price_idle') + $driver->tDirections->sum('price_order');
                                    @endphp

                                    <div class="col-2">{{$total}}</div>

                                </div>
                            @endforeach
                        </div>
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
                        <div class="card rounded-lg col-12">
                                <div class="row card-header text-center bg-warning">
                                    <div class="col-12">Фактури</div>
                                </div>
                                <div class="row card-header">
                                    <div class="col-2">Возач</div>
                                    <div class="col-2">Основно</div>
                                    <div class="col-2">Чекање</div>
                                    <div class="col-2">Порачка</div>
                                    <div class="col-2">Вкупно</div>
                                    <div class="col-2">Компанија</div>
                                </div>
                                {{--@dd($invoices)--}}

                                @foreach($invoices as $invoice)
                                    {{--                                @dd($invoice)--}}
                                    <div class="row pb-2 pt-2 ">
                                        <div class="col-2">{{$invoice->driver->full_name}}</div>
                                        <div class="col-2">{{$invoice->price}}</div>
                                        <div class="col-2">{{$invoice->price_idle}}</div>
                                        <div class="col-2">{{$invoice->price_order}}</div>

                                        @php
                                            $total = $invoice->price + $invoice->price_idle + $invoice->price_order;
                                        @endphp

                                        <div class="col-2">{{$total}}</div>
                                        <div class="col-2">{{$invoice->company->name}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
