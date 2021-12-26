@extends('layouts.master')


@section('content')
    @include('layouts.user-menu')
    <div class="container-fluid mt-3">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <form action="{{route('assignDriver')}}" method="POST">
                            @csrf
                            <p>Shift driver for car: <span id="carNameToAssign"></span></p>
{{--                            <input type="hidden" value="" name="car" id="carToAssign">--}}
                            <div class="row">
                                <div class="form-group col-8">
                                    <select class="from_location location form-control" name="driver_id" required>
                                        <option value=""></option>
                                        @foreach($drivers as $driver)
                                            <option
                                                value="{{$driver->id}}">{{$driver->first_name}} {{$driver->last_name}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-8">
                                    <select class="from_location location form-control" name="car" required>
                                        <option value=""></option>
                                        @foreach($cars as $car)
                                            <option
                                                value="{{$car->id}}">{{$car->name}} {{$car->registration_number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <textarea placeholder="Note" class="w-100" name="note"></textarea>
                                </div>
                                <div class="form-group col-6">
                                    <input type="number" placeholder="km" class="w-100" name="km" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6 text-center">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                                <div class="col-6 text-center">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
