@extends('layouts.master')

@section('content')
    @include('layouts.user-menu')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <div class="card rounded-lg col-12">
                            <div class="row card-header">
                                <div class="col-4">Возач</div>
                                <div class="col-2">Основно</div>
                                <div class="col-2">Чекање</div>
                                <div class="col-2">Порачка</div>
                                <div class="col-2">Вкупно</div>
                            </div>

                            @foreach($driverInvoices as $invoice)
                                        <div class="row pb-2 pt-2 ">
                                    @php
                                    $total = $invoice->priceBase + $invoice->priceIdle + $invoice->priceOrder;
                                    @endphp


                                    <div class="col-4">{{$invoice->first_name . ' ' . $invoice->last_name}}</div>
                                    <div class="col-2 ">{{$invoice->priceBase}}</div>
                                    <div class="col-2">{{$invoice->priceIdle}}</div>
                                    <div class="col-2">{{$invoice->priceOrder}}</div>
                                    <div class="col-2">{{$total}}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
