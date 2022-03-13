@extends('layouts.master')


@section('content')

    <div class="row">

        <div class="col-6">

            <form action="{{ route('showServices', ['car' => $car->id]) }}" method="POST">
                @csrf

                <label for="dateFrom">
                    Од: <input type="date" name="dateFrom" id="dateFrom" class="form-control">
                </label>

                <label for="dateTo">
                    До: <input type="date" name="dateTo" id="dateTo" class="form-control">
                </label>

                <button type="submit" class="btn btn-warning">Прикажи</button>
            </form>
        </div>

        <div class="col-6">
            <h3>Сервиси за {{$car->name}}</h3>
        </div>

    </div>

    <div class="container-fluid mt-3">
        <div>
            <table id="myTable">
                <thead>
                <tr>
                    <th>Вид</th>
                    <th>Цена</th>
                    <th>Километри</th>
                    <th>Дата</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $sum = 0;
                @endphp
                @foreach($services as $service)
                    <tr>
                        <td>{{$service->name}}</td>
                        <td>{{$service->pivot->price}} ден.</td>
                        <td>{{$service->pivot->km}} км</td>
                        <td>{{$service->pivot->created_at}}</td>
                    </tr>

                    @php
                        $totalSum = $service->pivot->price;
                        $sum += $totalSum
                    @endphp
                @endforeach

                </tbody>
            </table>


            <div class="d-flex flex-row form-control border-primary">
                <div>Вкупно:</div>
                <div>{{$sum}} ден</div>
            </div>
        </div>
    </div>
    @php
        if (!request('dateFrom')) {
                $startDate = today()->startOfDay()->format("Y-m-d H:i:s");
            } else
                $startDate = request()->dateFrom;

            if (!request('dateTo')) {
                    $endDate = now()->endOfDay()->format("Y-m-d H:i:s");
                } else
                    $endDate = request()->dateTo;
    @endphp

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'columnsToggle',

                    {
                        extend: 'excelHtml5',
                        text: 'Export во Excel',
                        title: 'Сервиси за {{$car->name}} од {{$startDate}} до {{$endDate}}',
                        className: 'btn btn-primary',
                        init: function (api, node, config) {
                            $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    }
                ]
            });

        });
    </script>
@stop
