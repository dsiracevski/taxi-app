@extends('layouts.master')

@section('content')
    @include('layouts.admin-menu')

    <table>
        <thead>
        <tr>
            <th>Име на компанија</th>
        </tr>
        </thead>

        <tbody>

        <tr>
            <form method="POST" class="d-inline" action="{{route('updateCompany', ['company' => $company->id])}}">
                @csrf
                @method('PATCH')
                <td class="d-inline">
                    <input value="{{ $company->name }}" name="name">

                    <div class="form-group d-inline">
                        <button type="submit" class="btn btn-primary d-inline">Промени</button>
                    </div>
                </td>
            </form>
        </tr>

        </tbody>
    </table>

@endsection
