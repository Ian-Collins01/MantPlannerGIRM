<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Ticket de Mantenimiento') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('maintenances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="is_ticket" value="true">
            <input type="hidden" name="date" value="{{ old('date', Carbon\Carbon::now()->format('Y-m-d')) }}">
            <input type="hidden" name="maintenance_type" value="1">
            <input type="hidden" name="applicant_id" value="{{ Auth::user()->id }}">

            <div class="card mb-2">
                <div class="card-body">

                    <div class="row">
                        <div class="col mb-3">
                            <label class="form-label">Máquina</label>
                            <select name="machine_id" class="form-select select2" required>
                                <option value="" disabled selected>-- Selecciona --</option>
                                @foreach ($machines as $area => $groupedMachines)
                                    <optgroup label="{{ $area }}">
                                        @foreach ($groupedMachines as $machine)
                                            <option value="{{ $machine->id }}"
                                                {{ old('machine_id') == $machine->id ? 'selected' : '' }}>
                                                {{ $machine->name }}
                                            </option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col mb-3">
                            <label for="task_header_id" class="form-label">Plantilla de actividades</label>
                            <select name="task_header_id[]" id="task_header_id" multiple="multiple"
                                class="form-select select2multiple">
                                @foreach ($taskHeaders as $header)
                                    <option value="{{ $header->id }}">{{ $header->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col mb-2">
                            <label class="form-label d-block">Tipo de Mantenimiento</label>
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
                    </div>


                    <div class="col-12 mb-2">
                        <label class="form-label">Descripción</label>
                        <textarea name="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('maintenances.index') }}">
                            <x-secondary-button>Cancelar</x-secondary-button>
                        </a>
                        <x-primary-button>Crear</x-primary-button>
                    </div>

                </div>
            </div>
        </form>
    </div>
</x-app-layout>
