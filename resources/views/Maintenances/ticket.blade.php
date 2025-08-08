<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Ticket de Mantenimiento') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <form action="{{ route('maintenances.store') }}" method="POST">
            @csrf
            <input type="hidden" name="notice_hour"
                value="{{ old('notice_hour', \Carbon\Carbon::now()->format('H:i')) }}">
            <input type="hidden" name="date" value="{{ old('date', Carbon\Carbon::now()->format('Y-m-d')) }}">
            <input type="hidden" name="maintenance_type" value="1">
            <input type="hidden" name="applicant_id" value="{{ Auth::user()->id }}">

            <div class="card mb-2">
                <div class="card-body">

                    <div class="mb-3">
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
