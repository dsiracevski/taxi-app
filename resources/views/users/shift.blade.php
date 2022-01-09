@extends('layouts.master')

@section('content')
    @include('layouts.user-menu')
    {{--        @dd($drivers)--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        <table id="myTable">
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
                            <tr>
                                @foreach($drivers as $driver)
                                    <td>{{$driver->full_name}}</td>
                                    @foreach($driver->cars as $car)
                                        <td>{{$car->pivot->km}}</td>
                                    @endforeach
                                    <td>{{$driver->tDirections->sum('price')}}</td>
                                    <td>{{$driver->tDirections->sum('price_idle')}}</td>
                                    <td>{{$driver->tDirections->sum('price_order')}}</td>


                                    @php
                                        $total = $driver->tDirections->sum('price') + $driver->tDirections->sum('price_idle') + $driver->tDirections->sum('price_order');
                                    @endphp

                                    <td>{{$total}}</td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                        <table id="myTable2">
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
                            @foreach($invoices as $invoice)
                                <tr>

                                    <td>{{$invoice->driver->full_name}}</td>
                                    <td>{{$invoice->price}}</td>
                                    <td>{{$invoice->price_idle}}</td>
                                    <td>{{$invoice->price_order}}</td>

                                    @php
                                        $total = $invoice->price + $invoice->price_idle + $invoice->price_order;
                                    @endphp

                                    <td>{{$total}}</td>
                                    <td>{{$invoice->company->name}}</td>
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
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                columnDefs: [
                    {
                        targets: 0,
                        className: 'noVis'
                    }
                ],
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Такси Шлифка - Крај на Смена ({{auth()->user()->getFullNameAttribute() . " - " . today()->toDateString()}})'
                    },
                    {

                        extend: 'colvis',
                        columns: ':not(.noVis)'
                    }

                ]
            });

            $('#myTable2').DataTable({
                dom: 'Bfrtip',
                columnDefs: [
                    {
                        targets: 0,
                        className: 'noVis'
                    }
                ],
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Такси Шлифка - Фактури ({{auth()->user()->getFullNameAttribute() . " - " . today()->toDateString()}})'
                    },
                    {

                        extend: 'colvis',
                        columns: ':not(.noVis)'
                    }

                ]
            });

        });
    </script>
@stop
