@extends('layouts.master')


@section('content')
    @include('layouts.user-menu')
    <div class="row">
        {{--@dd($booking)--}}
        <div class="container-fluid mt-3 col-3">
            <x-menu></x-menu>
        </div>

        <div class="container-fluid mt-3 col-9">
            <div class="row">
                <div class="col-12">
                    <div class="card card-rounded">

                        <table class="table">
                            <thead>
                            <tr>
                                <td>Време</td>
                                <td>Име</td>
                                <td>Забелешка</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <form method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <div>
                                        <td><input type="date" id="" placeholder="{{$booking->next_date}}"></td>
                                        <td><input type="text" placeholder="{{$booking->name}}"></td>
                                        <td><input type="text" placeholder="{{$booking->note}}"></td>
                                    </div>
                                    <div>
                                        <button type="submit">Edit</button>
                                    </div>
                                </form>

                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>



@endsection
