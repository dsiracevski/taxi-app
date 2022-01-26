@extends('layouts.master')


@section('content')
    @include('layouts.user-menu')
    <div class="row">
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9">
            <div class="row">
                <div class="col-12">
                    <div class="card card-rounded">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>Време</td>
                                <td>Име</td>
                                <td>Колку често</td>
                                <td>Забелешка</td>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bookings as $booking)

                                <tr>
                                    <td>{{$booking->next_date}}</td>
                                    <td><a href="{{route('viewBooking', $booking->id)}}">{{$booking->name}}</a></td>
                                    <td>
                                        @if ($booking->frequency === 'once')
                                            Еднаш
                                        @elseif(($booking->frequency === 'daily'))
                                            Секојдневно
                                        @elseif(($booking->frequency === 'monthly'))
                                            Месечно
                                        @endif
                                    </td>
                                    <td>{{$booking->note}}</td>
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
