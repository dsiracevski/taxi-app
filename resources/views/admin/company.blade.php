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
                                <div>
                                    <th>Име</th>
                                    <th></th>
                                </div>
                            </tr>
                            </thead>

                            <tbody>

                            <tr>
                                <form method="POST" class="form-row"
                                      action="{{route('updateCompany', ['company' => $company->id])}}">
                                    @csrf
                                    @method('PATCH')
                                    <td>
                                        <div class="form-group">
                                            <input value="{{ $company->name }}" name="name" class="form-control">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary d-inline">Промени име</button>
                                        </div>
                                    </td>
                                </form>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@endsection
