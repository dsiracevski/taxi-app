@extends('layouts.master')


@section('content')
    @include('layouts.admin-menu')


    {{--    @dd($companies)--}}
    <table>
        <thead>
        <tr>
            <th>Компанија</th>
        </tr>
        </thead>

        <tbody>

        @foreach($companies as $company)
            <tr>
                <td class="d-inline">{{$company->name}}</td>
                <td>
                    <a href="{{route('viewCompany', ['company' => $company->id])}}"
                       class="btn btn-primary d-inline">Промени</a>
                    <form method="POST" class="d-inline"
                          action="{{ route('deleteCompany', ['company' => $company->id]) }}">
                        @csrf
                        @method('DELETE')

                        <div class="form-group d-inline">
                            <input type="submit" class="btn btn-danger delete-company" value="Избриши">
                        </div>
                    </form>
                </td>
            </tr> 
        @endforeach
        </tbody>
    </table>

    <form method="POST">
        @csrf
        <div>
            <div class="d-inline">
                <input placeholder="Нова компанија" name="name">
            </div>

            <div class="d-inline">
                <button type="submit" class="btn btn-primary">Додади</button>
            </div>
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
