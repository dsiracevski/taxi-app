@extends('layouts.master')


@section('content')
    @include('layouts.admin-menu')

    <div class="row">

        <div class="col-6">

            <form action="{{ route('adminView') }}" method="POST">
                @csrf

                <label for="dateFrom">
                    Од: <input type="date" name="dateFrom" id="dateFrom">
                </label>

                <label for="dateTo">
                    До: <input type="date" name="dateTo" id="dateTo">
                </label>

                <button type="submit" class="btn button">Прикажи</button>
            </form>
        </div>


    </div>



    <div class="row">

        <div class="col-12">
            <table id="myTable" class="display card rounded-lg col-12">
                <thead>
                <tr class="row text-left">
                    <th class="col-2">Дата и час</th>
                    <th class="col-2">Диспечер</th>
                    <th class="col-2">Возач</th>
                    <th class="col-1">Од - До</th>
                    <th class="col-1">Цена</th>
                    <th class="col-1">Чекање</th>
                    <th class="col-1">Порачка</th>
                    <th class="col-1">Вкупно</th>
                    <th class="col-1">Фактура?</th>
                </tr>
                </thead>

                <tbody>
                @foreach($directions as $d)

                    <tr class="row pb-2 pt-2 text-left">
                        <td class="col-2">{{$d->created_at}}</td>
                        <td class="col-2">{{$d->userFirst . ' ' . $d->userLast}}</td>
                        <td class="col-2">{{$d->first_name . ' ' . $d->last_name}}</td>
                        <td
                            class="col-1">{{$d->from_street_name . ' ' . $d->street_number_from}} {{$d->to_street_name . ' ' . $d->street_number_to}}</td>
                        <td class="col-1">{{$d->price}} ден</td>
                        <td class="col-1">{{$d->price_idle}} ден</td>
                        <td class="col-1">{{$d->price_order}} ден</td>
                        @php
                            $sum = 0;
                        @endphp
                        @php
                            $totalSum = $d->price + $d->price_idle + $d->price_order;
                             if (!$d->invoice) $sum += $totalSum;
                        @endphp

                        <td class="col-1">{{$totalSum}} ден</td>
                        <td class="col-1">@if ($d->invoice) Да @else Не @endif</td>
                    </tr>
                @endforeach

                </tbody>
            </table>

            <div class="row card-footer">
                <div class="col-11">Вкупно</div>
                <div class="col-1 text-left">{{$sum}} ден</div>
            </div>
            {{--                @endforeach--}}

        </div>
        @if(!empty($cars))
            <div class="col-4">
                <div class="p-5">
                    @foreach($cars as $car)
                        <div>{{$car->name}}
                            <a href="#" class="shift_driver"
                               data-toggle="modal"
                               data-target="#shiftDriver"
                               data-driver-id=""
                               data-car-name="{{$car->name}}"
                               data-car-id="{{$car->id}}">
                                Add
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

@stop

@section('script')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable();
        });
    </script>
@stop
