<div>

    <div class="list-group">
        <?php foreach ($allCars as $car):?>
        <a href="/directions/driver/{{$car->onWorkCars[0]->pivot->driver_id}}"
           class="list-group-item list-group-item-action flex-column align-items-start">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{$car->name}}</h5>
                <small>Смена {{$car->onWorkCars[0]->pivot->shift}}</small>
            </div>
            <div class="d-flex w-100 justify-content-between">
                @if(isset($car->onWorkCars[0]) && !empty($car->onWorkCars[0]))
                    <small>{{$car->onWorkCars[0]->first_name}} {{$car->onWorkCars[0]->last_name}}</small>
                @endif
                <small>почетна: {{$car->onWorkCars[0]->pivot->km}} km</small>
                <small>почеток на смена: {{$car->onWorkCars[0]->pivot->created_at}}</small>
            </div>
            <div class="d-flex w-100 justify-content-between">
                <small></small>

            </div>
            {{isset($car->onWorkCars[0]) ? $car->onWorkCars[0]->pivot_note : ''}}
            <p class="mb-1">{{$car->onWorkCars[0]->pivot->note}}</p>

        </a>
        <?php endforeach;?>
        <a href="{{route('endShiftDriver')}}" class="list-group-item list-group-item-action">Почеток/Крај на смена за
            возач</a>
        <a href="#" data-toggle="modal" data-target="#addScheduledRoute" class="list-group-item list-group-item-action">Закажи
            возило</a>
        <a href="{{route('viewBookings')}}" class="list-group-item list-group-item-action">Закажани за следните 7
            дена</a>
        <a href="{{route('viewServices')}}" class="list-group-item list-group-item-action">Одржување</a>
        <a href="{{route('endShift')}}" class="list-group-item list-group-item-action bg-info">Крај на смена</a>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="list-group-item list-group-item-action bg-warning">Излез</button>
        </form>


    </div>
</div>
