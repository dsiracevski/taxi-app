@extends('layouts.master')

@section('content')
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
                                <th>Име</th>
                                <th>Презиме</th>
                                <th>Активен?</th>
                            </tr>
                            </thead>

                            <tbody>
                            <tr>
                                <form method="POST" action="{{route('updateDriver', ['driver' => $driver->id])}}">

                                    @csrf
                                    @method('PUT')

                                    <div>
                                        <td><input value="{{ $driver->first_name }}" name="first_name"
                                                   class="form-control"></td>
                                        <td><input value="{{ $driver->last_name }}" name="last_name"
                                                   class="form-control"></td>
                                        <td>
                                            <input name="is_active" type="hidden" value="0" hidden>
                                            <label for="active">Да</label>
                                            <input type="checkbox" name="is_active"
                                                   @if ($driver->is_active) checked="checked" @endif value="1">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Промени</button>
                                        </td>
                                    </div>
                                </form>

                                <form method="POST" action="{{route('deleteDriver', $driver->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <div>
                                        <td>
                                            <button type="submit" class="btn btn-danger">Избриши</button>

                                        </td>
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
