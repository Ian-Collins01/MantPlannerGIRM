<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>

        <link rel="stylesheet" href="{{ asset('css/dashboardCards.css') }}">

    </x-slot>

    <div class="container mt-4">
        <div class="row">

            <div class="col mb-2">
                <a href="{{ route('maintenances.index') }}">
                    <div class="card-card">
                        <p class="p-card">Mantenimientos</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-cone-striped icon"
                            viewBox="0 0 16 16">
                            <path
                                d="m9.97 4.88.953 3.811C10.159 8.878 9.14 9 8 9s-2.158-.122-2.923-.309L6.03 4.88C6.635 4.957 7.3 5 8 5s1.365-.043 1.97-.12m-.245-.978L8.97.88C8.718-.13 7.282-.13 7.03.88L6.275 3.9C6.8 3.965 7.382 4 8 4s1.2-.036 1.725-.098m4.396 8.613a.5.5 0 0 1 .037.96l-6 2a.5.5 0 0 1-.316 0l-6-2a.5.5 0 0 1 .037-.96l2.391-.598.565-2.257c.862.212 1.964.339 3.165.339s2.303-.127 3.165-.339l.565 2.257z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="col mb-2">
                <a href="{{ route('task-headers.index') }}">
                    <div class="card-card">
                        <p class="p-card">Lista de Actividades</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-wrench icon"
                            viewBox="0 0 16 16">
                            <path
                                d="M.102 2.223A3.004 3.004 0 0 0 3.78 5.897l6.341 6.252A3.003 3.003 0 0 0 13 16a3 3 0 1 0-.851-5.878L5.897 3.781A3.004 3.004 0 0 0 2.223.1l2.141 2.142L4 4l-1.757.364zm13.37 9.019.528.026.287.445.445.287.026.529L15 13l-.242.471-.026.529-.445.287-.287.445-.529.026L13 15l-.471-.242-.529-.026-.287-.445-.445-.287-.026-.529L11 13l.242-.471.026-.529.445-.287.287-.445.529-.026L13 11z" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="col mb-2">
                <a href="{{ route('maintenances.calendar') }}">
                    <div class="card-card">
                        <p class="p-card">Calendario</p>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-calendar-event icon"
                            viewBox="0 0 16 16">
                            <path
                                d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z" />
                            <path
                                d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z" />
                        </svg>
                    </div>
                </a>
            </div>
        </div>

    </div>
</x-app-layout>
