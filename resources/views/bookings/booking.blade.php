@extends('layouts.master')


@section('content')

    @if (Auth::user()->is_admin)
        @include('layouts.admin-menu')
    @else
        @include('layouts.user-menu')
    @endif

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
                                <td>Промени Време</td>
                                <td>Промени Име</td>
                                <td>Промени Колку често</td>
                                <td>Промени Забелешка</td>
                                <td>Неактивно?</td>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <form action="{{route('updateBooking', $booking->id)}}" method="POST" id="booking">
                                    @csrf
                                    @method('PUT')
                                    <div class="d-flex">
                                        <div class="d-flex flex-row">
                                            <input type="hidden" name="id" value="{{$booking->id}}">
                                            <td><input type="text" class="form-control" placeholder="Почнува на" value="{{$booking->next_date}}"
                                                       name="next_date"
                                                       id="datetimepicker6"></td>
                                            <td><input type="text" name="name" class="form-control" value="{{$booking->name}}"
                                                       placeholder="{{$booking->name}}"></td>
                                            <td>
                                                <select name="frequency" class="form-control">
                                                    <option value="{{$booking->frequency}}"></option>
                                                    <option value="once">Еднаш</option>
                                                    <option value="daily">Секојдневно</option>
                                                    <option value="monthly">Месечно</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="note" class="form-control" value="{{$booking->note}}"
                                                       placeholder="{{$booking->note}}"></td>
                                            <td>
                                                <div class="form-group form-check d-flex align-items-center">
                                                    <input type="checkbox" class="form-check-input" value="1"
                                                           name="is_active">
                                                    <label class="form-check-label" >Да</label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary">
                                                    Промени
                                                </button>
                                            </td>
                                        </div>
                                    </div>
                                </form>
                                <form action="{{route('deleteBooking', $booking->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <td>
                                        <div class="form-group">
                                            <input type="submit" class="btn btn-danger delete-user" value="Избриши">
                                        </div>
                                    </td>
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

@section('script')
    <script>
        $(document).ready(function () {

            $('#datetimepicker6').datetimepicker({
                lang: 'mk',
                step: 5
            });
        });

        $('.delete-user').click(function(e){
            e.preventDefault() // Don't post the form, unless confirmed
            if (confirm('Дали сте сигурни?')) {
                // Post the form
                $(e.target).closest('form').submit() // Post the surrounding form
            }
        });
    </script>
@stop
