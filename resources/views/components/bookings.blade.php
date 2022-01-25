<div class="bookings">
    <p>
        <a class="btn btn-primary" data-toggle="collapse" href="#collapse" role="button"
           aria-expanded="false" aria-controls="collapse">
            Закажани Возила
        </a>
    </p>
    <div class="collapse" id="collapse">
        <table class="table table-striped">
            <thead>
            <tr>
                <td>Време</td>
                <td>Име</td>
                <td>Забелешка</td>
            </tr>
            </thead>
            <tbody>
            @foreach($bookings as $booking)

                <tr>
                    <td>{{$booking->next_date}}</td>
                    <td>{{$booking->name}}</td>
                    <td>{{$booking->note}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
