<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Такси Шливка</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav m-auto">
            <li class="nav-item">
                <a href="/register/" class="nav-link">Додади корисни</a>
            </li>
            <li class="nav-item">
                <a href="{{route('viewDrivers')}}" class="nav-link">Возачи</a>
            </li>
            <li class="nav-item">
                <a href="{{route('viewCars')}}" class="nav-link">Возила</a>
            </li>
            <li>
                <a href="{{route('viewLocations')}}" class="nav-link">Локации</a>
            </li>
            <li>
                <a href="{{route('viewUsers')}}" class="nav-link">Корисници</a>
            </li>
            <li>
                <a href="{{route('assignDriver')}}" class="nav-link">Кола/Возач</a>
            </li>
            <li>
                <a href="{{ route('adminView') }}/" class="nav-link">Рути</a>
            </li>

            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="nav-link border-0 bg-light">Излез</button>
                </form>
            </li>
        </ul>
        <span>{{auth()->user()->first_name}} {{auth()->user()->last_name}}</span>
    </div>
</nav>
