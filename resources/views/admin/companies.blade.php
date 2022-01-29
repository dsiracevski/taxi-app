@extends('layouts.master')

@section('content')
    @include('layouts.admin-menu')

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
                                <th>Компанија</th>
                            </tr>
                            </thead>

                            <tbody>

                            @foreach($companies as $company)
                                <tr>
                                    <td>{{$company->name}}</td>
                                    <td>
                                        <a href="{{route('viewCompany', ['company' => $company->id])}}"
                                           class="btn btn-primary">Промени</a>
                                    </td>
                                    <td>
                                        <form method="POST"
                                              action="{{ route('deleteCompany', ['company' => $company->id]) }}">
                                            @csrf
                                            @method('DELETE')

                                            <td>
                                                <input type="submit" class="btn btn-danger delete-company"
                                                       value="Избриши">
                                            </td>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <form method="POST" class="form-row mt-3 ml-1">
                @csrf
                    <div class="form-group">
                        <input placeholder="Нова компанија" name="name" class="form-control">
                    </div>

                    <div class="form-group mx-3">
                        <button type="submit" class="btn btn-primary">Додади</button>
                    </div>
            </form>


            @endsection

            @section('script')
                <script>
                    $('.delete-company').click(function (e) {
                        e.preventDefault() // Don't post the form, unless confirmed
                        if (confirm('Дали сте сигурни?')) {
                            // Post the form
                            $(e.target).closest('form').submit() // Post the surrounding form
                        }
                    });

                </script>


@stop
