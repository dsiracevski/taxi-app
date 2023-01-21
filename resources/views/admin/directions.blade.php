@extends('layouts.master')


@section('content')
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
{{--                    @dump($direction->price_idle)--}}
                    <tr>
                        {{--                        @dd($directions);--}}
                        <td>{{$direction->created_at}}</td>
                        <td>{{$direction->users->full_name}}</td>
                        <td>{{$direction->driver->full_name}}</td>
                        <td
                        >
                            @if ($direction->locationFrom)
                                {{$direction->locationFrom->street_name . ' ' . $direction->locationFrom->street_number}}
                            @endif
                            -
                            @if ($direction->locationTo)
                                {{$direction->locationTo->street_name . ' ' . $direction->locationTo->street_number}}
                            @endif
                            @if ($direction->return)
                                (ПОВРАТНА)
                            @else

                            @endif
                        </td>
                        <td>@if(!$direction->price)
                                0
                            @else
                                {{$direction->price}}

                            @endif</td>
                        <td>@if(!$direction->price_idle)
                                0
                            @else
                                {{$direction->price_idle}}

                            @endif</td>
                        <td>@if(!$direction->price_order)
                                0
                            @else
                                {{$direction->price_order}}

                            @endif</td>

                        @php
                            $totalSum = $direction->price + $direction->price_idle + $direction->price_order;
                             if (!$direction->invoice) $sum += $totalSum;
                        @endphp

                        <td>{{$totalSum}}</td>
                        <td>@if ($direction->company_id) {{$direction->company->name}} @else Во Готово @endif</td>
                        @if(isset($direction->car->name))
                            <td>{{$direction->car->name}}</td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="d-flex flex-row form-control border-primary text-right">
                <div>Вкупно за наплата:</div>
                <div>{{$sum}}</div>
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
                        init: function (api, node, config) {
                            $(node).removeClass('dt-button buttons-excel buttons-html5')
                        }
                    }
                ]
            });

        });
    </script>
@stop
