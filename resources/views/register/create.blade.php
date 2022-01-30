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

                        <form action="{{route('registerUser')}}" method="POST" class="m-3">
                            @csrf

                            <div class="form-row">
                                <div class="form-group col-6">
                                    <label for="first_name">Име</label>
                                    <input type="text" name="first_name" id="first_name" class="form-control" required>
                                </div>

                                <div class="form-group col-6">
                                    <label for="last_name">Презиме</label>
                                    <input type="text" name="last_name" id="last_name" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="password">Лозинка</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="form-check">
                                <input type="hidden" name="is_admin" value="0">
                                <input type="checkbox" name="is_admin" id="is_admin" value="1" class="form-check-input">
                                <label for="is_admin" class="form-check-label">Администратор?</label>
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">
                                    Додади
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

@endsection
