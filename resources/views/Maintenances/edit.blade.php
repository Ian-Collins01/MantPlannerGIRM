<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editar Mantenimiento #') }}{{ $maintenance->id }}
            </h2>
            <div>
                <x-danger-button x-data=""
                    x-on:click.prevent="$dispatch('open-modal', 'confirm-record-deletion')">Eliminar</x-danger-button>
            </div>
        </div>
    </x-slot>

    <x-modal name="confirm-record-deletion">
        <form action="{{ route('maintenances.destroy', $maintenance) }}" method="POST" class="p-6">
            @csrf
            @method('DELETE')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('¿Estás seguro de eliminar este mantenimiento?') }}
            </h2>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Cancelar
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    Eliminar
                </x-danger-button>
            </div>
        </form>
    </x-modal>

    <div class="container mt-4">
        <form action="{{ route('maintenances.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card mb-2">
                <div class="card-body">
                    <div class="row d-flex justify-end">
                        <div class="col-md-4 mb-2">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="date" class="form-control"
                                value="{{ old('date', $maintenance->date) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Aviso</label>
                            <input type="time" name="notice_hour" class="form-control"
                                value="{{ old('notice_hour', $maintenance->notice_hour ? \Carbon\Carbon::parse($maintenance->notice_hour)->format('H:i') : null) }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Inicio</label>
                            <input type="time" name="start_hour" class="form-control"
                                value="{{ old('start_hour', $maintenance->start_hour ? \Carbon\Carbon::parse($maintenance->start_hour)->format('H:i') : null) }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Entrega</label>
                            <input type="time" name="lead_time" class="form-control"
                                value="{{ old('lead_time', $maintenance->lead_time ? \Carbon\Carbon::parse($maintenance->lead_time)->format('H:i') : null) }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Fin</label>
                            <input type="time" name="end_hour" class="form-control"
                                value="{{ old('end_hour', $maintenance->end_hour ? \Carbon\Carbon::parse($maintenance->end_hour)->format('H:i') : null) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-2">
                            <label class="form-label">Máquina</label>
                            <select name="machine_id" class="form-select select2" required>
                                <option value="" disabled>-- Selecciona --</option>
                                @foreach ($machines as $machine)
                                    <option value="{{ $machine->id }}"
                                        {{ old('machine_id', $maintenance->machine_id) == $machine->id ? 'selected' : '' }}>
                                        {{ $machine->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">Técnico</label>
                            <select name="technician_id" class="form-select select2">
                                <option value="" disabled selected>-- Selecciona --</option>
                                @foreach ($technicians as $tech)
                                    <option value="{{ $tech->id }}"
                                        {{ old('technician_id', $maintenance->technician_id) == $tech->id ? 'selected' : '' }}>
                                        {{ $tech->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col mb-2">
                            <label class="form-label">Aplicante</label>
                            <select name="applicant_id" class="form-select select2">
                                <option value="" disabled selected>-- Selecciona --</option>
                                @foreach ($applicants as $applicant)
                                    <option value="{{ $applicant->id }}"
                                        {{ old('applicant_id', $maintenance->applicant_id) == $applicant->id ? 'selected' : '' }}>
                                        {{ $applicant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="task_header_id" class="form-label">Plantilla de actividades</label>
                            <select name="task_header_id[]" id="task_header_id" multiple="multiple"
                                class="form-select select2">
                                <option value="" disabled>-- Selecciona --</option>
                                @foreach ($taskHeaders as $header)
                                    <option value="{{ $header->id }}"
                                        {{ in_array($header->id, old('task_header_id', $selectedTaskHeaders)) ? 'selected' : '' }}>
                                        {{ $header->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label d-block">Tipos de Mantenimiento</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="d-flex flex-wrap gap-3">
                                    @foreach ($types as $type)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="maintenance_type"
                                                value="{{ $type->id }}" id="type_{{ $type->id }}"
                                                {{ old('maintenance_type', $maintenance->maintenanceType->id) == $type->id ? 'checked' : '' }}
                                                required>
                                            <label class="form-check-label" for="type_{{ $type->id }}">
                                                {{ $type->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label class="form-label d-block">¿Hubo Paro?</label>
                            <div class="border rounded p-3 bg-light">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_stoppage" value="1"
                                        {{ old('has_stoppage', $maintenance->has_stoppage) == 1 ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_stoppage" value="0"
                                        {{ old('has_stoppage', $maintenance->has_stoppage) == 0 ? 'checked' : '' }}
                                        required>
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" rows="4" class="form-control" required>{{ old('description', $maintenance->description) }}</textarea>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('maintenances.show', $maintenance) }}">
                                <x-secondary-button>Cancelar</x-secondary-button>
                            </a>
                            <x-primary-button>Actualizar</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
