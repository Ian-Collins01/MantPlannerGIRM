<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>

        <link rel="stylesheet" href="{{ asset('css/dashboardCards.css') }}">

    </x-slot>

    <div class="container mt-5">
        <div class="row">
            <div class="col mb-5">
                <div class="card-card">
                    <div class="containers-card">
                        <div class="icon-circle-card">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#00c867" class="bi bi-cone-striped icon"
                                viewBox="0 0 16 16" weight="29" width="28">
                                <path
                                    d="m9.97 4.88.953 3.811C10.159 8.878 9.14 9 8 9s-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12m-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4s1.2-.036 1.725-.098m4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257z" />
                            </svg>
                        </div>
                        <div class="title-card mb-3">Mantenimientos</div>
                        <div class="subtitle-card">
                        </div>
                        <div class="d-flex justify-around">
                            <a
                                href="{{ route(Auth::user()->userType->name === 'Comun' ? 'maintenances.ticket' : 'maintenances.create') }}">
                                <div class="btnRound-card btnService-card">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 18"
                                        height="18" width="19">
                                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                            stroke="#23C55E"
                                            d="M3.51141 2.78405L14.9344 6.95805C15.4154 7.13405 15.4014 7.81905 14.9134 7.97605L9.68541 9.64905L8.01241 14.8771C7.85641 15.3651 7.17041 15.3791 6.99441 14.8981L2.82141 3.47405C2.66441 3.04405 3.08141 2.62705 3.51141 2.78405Z">
                                        </path>
                                    </svg>
                                    <p class="m-2">Nuevo</p>
                                </div>
                            </a>
                            <a href="{{ route('maintenances.index') }}">
                                <div class="btnRound-card btnService-card">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 18"
                                        height="18" width="19">
                                        <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                            stroke="#23C55E"
                                            d="M3.51141 2.78405L14.9344 6.95805C15.4154 7.13405 15.4014 7.81905 14.9134 7.97605L9.68541 9.64905L8.01241 14.8771C7.85641 15.3651 7.17041 15.3791 6.99441 14.8981L2.82141 3.47405C2.66441 3.04405 3.08141 2.62705 3.51141 2.78405Z">
                                        </path>
                                    </svg>
                                    <p class="m-2">Ver</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->userType->name != 'Comun')
                <div class="col mb-5">
                    <div class="card-card">
                        <div class="containers-card">
                            <div class="icon-circle-card">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#00c867" class="bi bi-wrench icon"
                                    viewBox="0 0 16 16" eight="29" width="28">
                                    <path
                                        d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z" />
                                </svg>
                            </div>
                            <div class="title-card mb-3">Listas de Actividades</div>
                            <div class="subtitle-card">
                            </div>
                            <div class="d-flex justify-around">
                                <a href="{{ route('task-headers.index') }}">
                                    <div class="btnRound-card btnService-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 18"
                                            height="18" width="19">
                                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                                stroke="#23C55E"
                                                d="M3.51141 2.78405L14.9344 6.95805C15.4154 7.13405 15.4014 7.81905 14.9134 7.97605L9.68541 9.64905L8.01241 14.8771C7.85641 15.3651 7.17041 15.3791 6.99441 14.8981L2.82141 3.47405C2.66441 3.04405 3.08141 2.62705 3.51141 2.78405Z">
                                            </path>
                                        </svg>
                                        <p class="m-2">Ver</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col mb-5">
                    <div class="card-card">
                        <div class="containers-card">
                            <div class="icon-circle-card">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="#00c867" class="bi bi-calendar-event icon"
                                    viewBox="0 0 16 16" weight="29" width="28">
                                    <path
                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                                </svg>
                            </div>
                            <div class="title-card mb-3">Calendario</div>
                            <div class="subtitle-card">
                            </div>
                            <div class="d-flex justify-around">
                                <a href="{{ route('maintenances.calendar') }}">
                                    <div class="btnRound-card btnService-card">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 18"
                                            height="18" width="19">
                                            <path stroke-linejoin="round" stroke-linecap="round" stroke-width="1.5"
                                                stroke="#23C55E"
                                                d="M3.51141 2.78405L14.9344 6.95805C15.4154 7.13405 15.4014 7.81905 14.9134 7.97605L9.68541 9.64905L8.01241 14.8771C7.85641 15.3651 7.17041 15.3791 6.99441 14.8981L2.82141 3.47405C2.66441 3.04405 3.08141 2.62705 3.51141 2.78405Z">
                                            </path>
                                        </svg>
                                        <p class="m-2">Ver</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

</x-app-layout>
