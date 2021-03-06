<div class="bookings bg-white">
    <div class="d-flex justify-content-between mb-3">
        <a class="btn btn-primary" data-toggle="collapse" href="#collapse" role="button"
           aria-expanded="false" aria-controls="collapse">
            Закажани Возила
        </a>
        <div class="pr-3"><a href="javascript:;" id="snooze"> <img src="{{asset('img/snooze.png')}}"  width="25px"></a></div>
    </div>
    <div class="collapse show" id="collapse">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Време</td>
                <td>Име</td>
                <td>Забелешка</td>
                <td></td>
            </tr>
            </thead>
            <tbody class="next-bookings-table">
            @foreach($bookings as $booking)
                <tr>
                    <td>{{$booking->next_date}}</td>
                    <td>{{$booking->name}}</td>
                    <td>{{$booking->note}}</td>
                    <td>
                        <form action="{{route('refreshBooking', $booking->id)}}" method="POST">
                            @csrf
                            <input type="hidden" name="booking" value="{{$booking->id}}">
                            <input type="submit" class="btn btn-primary"  value="Испрати"/>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

{{--@section('script')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}

{{--            $('#button').click(function () {--}}

{{--                // $.ajaxSetup({--}}
{{--                //     headers: {--}}
{{--                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                //     }--}}
{{--                // });--}}

{{--                $.ajax('{{route('refreshBooking', $booking->id)}}', {--}}
{{--                    type: 'POST',  // http method--}}
{{--                    data: {--}}
{{--                        myData: '{{$booking->next_date}}',--}}
{{--                        _token: '{{csrf_token()}}',--}}
{{--                    }, // data to submit--}}
{{--                    headers: {--}}
{{--                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
{{--                    },--}}
{{--                    success: function (data, status, xhr) {--}}
{{--                        $('p').append('status: ' + status + ', data: ' + data);--}}
{{--                    },--}}
{{--                    error: function (jqXhr, textStatus, errorMessage) {--}}
{{--                        $('p').append('Error: ' + errorMessage);--}}
{{--                    }--}}
{{--                });--}}
{{--            });--}}
{{--        });--}}
{{--    </script>--}}
{{--@stop--}}
