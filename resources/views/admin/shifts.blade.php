@extends('layouts.master')

@section('content')

    <div class="row">

        <div class="col-6">

            <form action="{{ route('viewShifts') }}" method="POST">
                @csrf

                <label for="dateFrom">
                    Од: <input type="date" name="dateFrom" id="dateFrom" class="form-control">
                </label>

                <label for="dateTo">
                    До: <input type="date" name="dateTo" id="dateTo" class="form-control">
                </label>

                <button type="submit" class="btn btn-primary">Прикажи</button>
            </form>
        </div>

    </div>

    {{--        @dd($cars)--}}
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-12">
                        {{--@dd($shifts)--}}
                        {{--                        @dd($withInvoice)--}}
                        <table id="myTable" class="table">
                            <thead>
                            <tr>
                                <th>Дата</th>
                                <th>Возач</th>
                                <th>Возило</th>
                                <th>Почетни километри</th>
                                <th>Поминал</th>
                                <th>Смена</th>
                                <th>Почеток на смена</th>
                                <th>Крај на смена</th>
                                <th>Забелешка</th>
                            </tr>

                            <tbody>
                            @php
                                $startKm = 0;
                                $endKm = 0;
                            @endphp
                            @foreach($shifts as $shift)

                                @php
                                    $date = \Carbon\Carbon::parse($shift->created_at);
                                    $startKm = $shift->km;
                                    $endKm = $shift->km_end - $startKm;
                                @endphp

                                <tr>
                                    <td>{{date_format($date, 'Y-m-d')}}</td>
                                    <td>{{$shift->first_name}} {{$shift->last_name}}</td>
                                    <td>{{$shift->car_name}}</td>
                                    <td>{{$startKm}} км</td>
                                    <td>{{$endKm}} км</td>
                                    <td>{{$shift->shift}}</td>
                                    <td>{{$shift->shift_start}}</td>
                                    <td>{{$shift->shift_end}}</td>
                                    <td>{{$shift->note}}</td>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @php
        if (!request('dateFrom')) {
                $startDate = today()->startOfDay()->format("Y-m-d H:i:s");
            } else
                $startDate = request()->dateFrom;

            if (!request('dateTo')) {
                    $endDate = now()->format("Y-m-d");
                } else
                    $endDate = request()->dateTo;
    @endphp


@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                pageLength: 10,
                buttons: [
                    'columnsToggle',

                    {
                        extend: 'excelHtml5',
                        text: 'Export во Excel',
                        title: 'Рути од {{$startDate}} до {{$endDate}}',
                        className: 'btn btn-primary',
                        init: function(api, node, config) {
                            $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    }
                ]
            });

        });
    </script>
@stop
