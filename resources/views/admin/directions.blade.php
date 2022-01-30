@extends('layouts.master')


@section('content')
    @include('layouts.admin-menu')

    <div class="row">

        <div class="col-6">

            <form action="{{ route('adminView') }}" method="POST">
                @csrf

                <label for="dateFrom">
                    Од: <input type="date" name="dateFrom" id="dateFrom" class="form-control">
                </label>

                <label for="dateTo">
                    До: <input type="date" name="dateTo" id="dateTo" class="form-control">
                </label>

                <button type="submit" class="btn button">Прикажи</button>
            </form>
        </div>

    </div>

    <div class="container-fluid mt-3">
{{--@dd(request())--}}
        <div>
            <table id="myTable">
                <thead>
                <tr>
                    <th>Дата и час</th>
                    <th>Диспечер</th>
                    <th>Возач</th>
                    <th>Од - До</th>
                    <th>Цена</th>
                    <th>Чекање</th>
                    <th>Порачка</th>
                    <th>Вкупно</th>
                    <th>Фактура?</th>
                    <th>Возило</th>
                </tr>
                </thead>

                <tbody>
                @php
                    $sum = 0;
                @endphp
                @foreach($directions as $direction)
                    <tr>
{{--                        @dd($directions);--}}
                        <td>{{$direction->created_at}}</td>
                        <td>{{$direction->users->full_name}}</td>
                        <td>{{$direction->driver->full_name}}</td>
                        <td
                        >{{$direction->locationFrom->street_name . ' ' . $direction->locationFrom->street_number}}
                            - {{$direction->locationTo->street_name . ' ' . $direction->locationTo->street_number}}
                        @if ($direction->return)
                            (ПОВРАТНА)
                            @else

                        @endif
                        </td>
                        <td>{{$direction->price}} ден</td>
                        <td>{{$direction->price_idle}} ден</td>
                        <td>{{$direction->price_order}} ден</td>

                        @php
                            $totalSum = $direction->price + $direction->price_idle + $direction->price_order;
                             if (!$direction->invoice) $sum += $totalSum;
                        @endphp

                        <td>{{$totalSum}} ден</td>
                        <td>@if ($direction->company_id) {{$direction->company->name}} @else Во Готово @endif</td>
                        @foreach($direction->driver->cars as $car)
                            <td>{{$car->name}}</td>
                        @endforeach
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="d-flex flex-row form-control border-primary" >
                <div>Вкупно за наплата:</div>
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
                    $endDate = now()->format("Y-m-d");
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
