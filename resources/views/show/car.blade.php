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
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Име</th>
                                <th>Број на регистрација</th>
                                <th>Вид на гориво</th>
                                <th>Во употреба?</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>

                            <tbody>

                            <tr>

                                <form method="POST" action="{{route('updateCar', ['car' => $car->id])}}">
                                    @csrf
                                    @method('PATCH')
                                    <div>
                                        <td><input value="{{ $car->name }}" name="name" class="form-control"></td>
                                        <td><input value="{{ $car->registration_number }}" name="registration_number" class="form-control">
                                        <td><select name="gas_type" class="form-control" required>
                                                <option value="Бензин" {{ $car->gas_type == 'Бензин' ? 'selected' : '' }}>Бензин</option>
                                                <option value="Дизел" {{ $car->gas_type == 'Дизел' ? 'selected' : '' }}>Дизел</option>
                                                <option value="Плин" {{ $car->gas_type == 'Плин' ? 'selected' : '' }}>Плин</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input name="is_active" type="hidden" value="0" hidden>
                                            <label for="active">Да</label>
                                            <input type="checkbox" name="is_active"
                                                   @if ($car->is_active) checked="checked" @endif value="1">
                                        </td>

                                    </div>

                                    <div>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Промени</button>

                                        </td>
                                    </div>
                                </form>

                                <form method="POST" action="{{route('deleteCar', ['car' => $car->id])}}">
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

    <div>

    </div>

@endsection
