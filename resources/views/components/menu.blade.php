<div>

            <div class="list-group">
                <?php foreach ($allCars as $car):?>
                <a href="/directions/driver/{{$car->onWorkCars[0]->pivot->driver_id}}" class="list-group-item list-group-item-action flex-column align-items-start">
                    <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1">{{$car->name}}</h5>
                        <small>Смена {{$car->onWorkCars[0]->pivot->shift}}</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        @if(isset($car->onWorkCars[0]) && !empty($car->onWorkCars[0]))
                            <small>{{$car->onWorkCars[0]->first_name}} {{$car->onWorkCars[0]->first_name}}</small>
                        @endif
                        <small>почетна: {{$car->onWorkCars[0]->pivot->km}} km</small>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <small></small>

                    </div>
                    {{isset($car->onWorkCars[0]) ? $car->onWorkCars[0]->pivot_note : ''}}
                    @php
                        // echo "<pre>";
                         //print_r($car->onWorkCars[0]->pivot->car_id);
                        // print_r();
                        // echo "</pre>";
                    @endphp
                    <p class="mb-1">{{$car->onWorkCars[0]->pivot->note}}</p>

                </a>
                <?php endforeach;?>
                <a href="{{route('endShiftDriver')}}" class="list-group-item list-group-item-action">Крај на смена за возач</a>
                <a href="#" class="list-group-item list-group-item-action">Гориво</a>
                <a href="#" class="list-group-item list-group-item-action">Одржување</a>
    </div>
</div>
