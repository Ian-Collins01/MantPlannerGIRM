<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Mantenimientos') }}
            </h2>
            <div>
                <a href="{{ route('maintenances.create') }}">
                    <x-primary-button>Crear Mantenimiento</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header text-bg-dark" data-bs-toggle="collapse" data-bs-target="#collapseFilter"
                        aria-expanded="false" aria-controls="collapseFilter">
                        Filtros
                    </div>
                    <div class="collapse card-body" id="collapseFilter">
                        <form method="GET" action="{{ route('maintenances.index') }}">
                            <div class="row">
                                <div class="col mb-2">
                                    <label for="start_date" class="form-label">Fecha Inicio</label>
                                    <input type="date" name="start_date" id="start_date"
                                        value="{{ request('start_date', $start_date) }}" class="form-control">
                                </div>

                                <div class="col mb-2">
                                    <label for="end_date" class="form-label">Fecha Fin</label>
                                    <input type="date" name="end_date" id="end_date"
                                        value="{{ request('end_date', $end_date) }}" class="form-control">
                                </div>

                                <div class="col mb-2">
                                    <label class="form-label d-block">Tipos de Mantenimiento</label>
                                    <div class="border rounded p-3 bg-light">
                                        <div class="d-flex flex-wrap gap-2">
                                            @foreach ($maintenanceTypes as $type)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox"
                                                        name="maintenance_type_ids[]" value="{{ $type->id }}"
                                                        id="type_{{ $type->id }}"
                                                        {{ is_array(request('maintenance_type_ids')) && in_array($type->id, request('maintenance_type_ids')) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="type_{{ $type->id }}">
                                                        {{ $type->name }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="text-end">
                                <x-primary-button>Filtrar</x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="card table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Fecha</th>
                        <th>Descripción</th>
                        <th>Máquina</th>
                        <th>Técnico</th>
                        <th>Tipo de Mantenimiento</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($maintenances as $maintenance)
                        <tr onclick="window.location='{{ route('maintenances.show',$maintenance) }}';"
                            style="cursor: pointer;">
                            <td>{{ \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') }}</td>
                            <td>{{ $maintenance->description }}</td>
                            <td>{{ $maintenance->machine->name ?? 'Sin máquina' }}</td>
                            <td>{{ $maintenance->technician->name ?? 'Sin técnico' }}</td>
                            <td>{{ $maintenance->maintenanceType->name ?? 'Sin tipo' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="alert alert-warning text-center m-0">
                                    No hay registros de mantenimientos con estos filtros.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
