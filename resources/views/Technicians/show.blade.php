<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Técnico: ') }} {{ $technician->name }}
        </h2>
    </x-slot>

    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Máquina');
            data.addColumn('number', 'Mantenimientos');

            // Pasar datos desde Blade a JS
            var machinesData = @json($maintenances->groupBy(fn($m) => $m->machine->name)->map(fn($items) => $items->count()));

            // Convertir a array de filas
            Object.entries(machinesData).forEach(([machine, count]) => {
                data.addRow([machine, count]);
            });

            var options = {
                chartArea: {
                    width: '70%',
                    height: 'auto'
                },
            };

            var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
            chart.draw(data, options);

            // Hacerlo responsive
            window.addEventListener('resize', () => chart.draw(data, options));
        }
    </script>


    <div class="container mt-4">

        <div class="d-flex justify-between row">
            <div class="col mb-3">
                {{-- Filtro de fechas --}}
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="GET" action="{{ route('technicians.show', $technician) }}">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="date" name="startDate" class="form-control"
                                        value="{{ $startDate }}">
                                </div>
                                <div class="col-md-6">
                                    <input type="date" name="endDate" class="form-control"
                                        value="{{ $endDate }}">
                                </div>
                            </div>
                            <div class="text-end mt-2">
                                <x-primary-button>Filtrar</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col mb-3">
                {{-- Card de horas trabajadas --}}
                <div class="card">
                    <div class="card-header text-bg-dark fw-bold">Minutos trabajados</div>
                    <div class="card-body h2 text-center">
                        {{ $maintenances->sum('maintenance_time') ? round($maintenances->sum('maintenance_time'),2) : 0 }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Tabla de mantenimientos --}}
        <div class="card">
            <div class="card-header text-bg-dark">Mantenimientos</div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-sm table-bordered table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th class="w-4">Fecha</th>
                                <th>Máquina</th>
                                <th>Descripción</th>
                                <th class="w-4">Estado</th>
                                <th class="w-4">Tiempo de Mantenimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($maintenances as $maintenance)
                                @php
                                    $badgeColor = \App\Models\Status::badgeColor($maintenance->status->id);
                                @endphp
                                <tr style="cursor: pointer;"
                                    onclick="window.location='{{ route('maintenances.show', $maintenance) }}'">
                                    <td>{{ $maintenance->date ? \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') : '---' }}
                                    </td>
                                    <td>{{ $maintenance->machine->name }}</td>
                                    <td>{{ $maintenance->description ?? '---' }}</td>
                                    <td>
                                        <span class="badge text-bg-{{ $badgeColor }}">
                                            {{ $maintenance->status->description ?? '---' }}
                                        </span>
                                    </td>
                                    <td>{{ $maintenance->maintenance_time ? round($maintenance->maintenance_time, 2) . ' min' : '---' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <div class="alert alert-warning text-center m-0">
                                            No hay mantenimientos asignados en este rango de fechas.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($maintenances->isNotEmpty())
            <div class="card mt-3">
                <div class="card-header text-bg-dark">
                    Mantenimiento por Máquina
                </div>
                <div class="card-body table-responsive" id="chart_div">
                </div>
            </div>
        @endif

        <div class="d-flex justify-end m-2">
            <div class="col-auto">
                <div class="card card-body">
                    <a href="{{ route('technicians.index') }}">
                        <x-secondary-button>Regresar</x-secondary-button>
                    </a>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
