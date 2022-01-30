@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger fade in alert-dismissible show">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(Session::has('message'))
                <div class="alert alert-{{session('message')['type']}} fade in alert-dismissible show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" style="font-size:20px">×</span>
                    </button>
                    {{session('message')['text']}}
                </div>
            @endif
        </div>
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

                            @foreach($drivers as $driver)
                                <tr>
                                    <td><a href="drivers/{{$driver->id}}">{{$driver->first_name}}</a></td>
                                    <td>{{$driver->last_name}}</td>
                                    <td>
                                        @if($driver->is_active)
                                            Да
                                        @else
                                            Не
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                            <form method="POST" action="{{route('addDriver')}}">
                                <tr>
                                    @csrf
                                    <div>
                                        <td>
                                            <input placeholder="Име" name="first_name"
                                                   class="form-control">
                                        </td>
                                        <td><input placeholder="Презиме" name="last_name"
                                                   class="form-control"></td>

                                        <td>
                                            <input name="is_active" type="checkbox" value="1" id="active">
                                            <label for="active">Да</label>
                                            <input name="is_active" type="hidden" value="0">
                                        </td>
                                        <td>
                                            <button type="submit" class="btn btn-primary">Додади нов</button>
                                        </td>
                                    </div>


                                </tr>
                            </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

@stop

