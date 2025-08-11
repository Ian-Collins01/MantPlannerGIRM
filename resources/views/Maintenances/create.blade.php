<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Mantenimiento') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('maintenances.store') }}" method="POST">
            @csrf
            <div class="card mb-2">
                <div class="card-body">
                    <div class="row d-flex justify-end">

                        <div class="col-md-4 mb-2">
                            <label for="repeat_interval" class="form-label">Repetir mantenimiento</label>
                            <select name="repeat_interval" id="repeat_interval" class="form-select">
                                <option value="">-- No repetir --</option>
                                <option value="monthly">Mensual (12 veces)</option>
                                <option value="semiannually">Semestral (2 veces)</option>
                            </select>
                        </div>


                        <div class="col-md-4 mb-2">
                            <label class="form-label">Fecha</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date', Carbon\Carbon::now()->format('Y-m-d')) }}"
                                required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Aviso</label>
                            <input type="time" name="notice_hour" class="form-control"
                                value="{{ old('notice_hour') }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Inicio</label>
                            <input type="time" name="start_hour" class="form-control"
                                value="{{ old('start_hour') }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Entrega</label>
                            <input type="time" name="lead_time" class="form-control"
                                value="{{ old('lead_time') }}">
                        </div>

                        <div class="col-md-3 mb-2">
                            <label class="form-label">Hora Fin</label>
                            <input type="time" name="end_hour" class="form-control" value="{{ old('end_hour') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mb-2">
                            <label class="form-label">Máquina</label>
                            <select name="machine_id" class="form-select select2" required>
                                <option value="" disabled selected>-- Selecciona --</option>
                                @foreach ($machines as $machine)
                                    <option value="{{ $machine->id }}"
                                        {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
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
                                        {{ old('technician_id') == $tech->id ? 'selected' : '' }}>
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
                                        {{ old('applicant_id') == $applicant->id ? 'selected' : '' }}>
                                        {{ $applicant->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="task_header_id" class="form-label">Plantilla de actividades</label>
                            <select name="task_header_id[]" id="task_header_id" multiple="multiple"
                                class="form-select select2" required>
                                @foreach ($taskHeaders as $header)
                                    <option value="{{ $header->id }}">{{ $header->name }}</option>
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
                                                {{ old('maintenance_type') == $type->id ? 'checked' : '' }} required>
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
                                        {{ old('has_stoppage') === '1' ? 'checked' : '' }} required>
                                    <label class="form-check-label">Sí</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="has_stoppage" value="0"
                                        {{ old('has_stoppage') === '0' ? 'checked' : '' }} required>
                                    <label class="form-check-label">No</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mb-2">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                        </div>

                        <div class="text-end">
                            <a href="{{ route('maintenances.index') }}">
                                <x-secondary-button>Cancelar</x-secondary-button>
                            </a>
                            <x-primary-button>Guardar</x-primary-button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
