<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Máquinas') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="card-body">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar en la tabla...">
                    </div>
                </div>

                <div class="card table-responsive">
                    <table class="table table-bordered table-hover" id="machineTable">
                        <thead class="table-dark">
                            <tr>
                                <th>Máquina</th>
                                <th>Area</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($machines as $machine)
                                <tr style="cursor: pointer;" data-id="{{ $machine->id }}"
                                    data-name="{{ $machine->name }}" data-area="{{ $machine->area_id }}">
                                    <td>{{ $machine->name }}</td>
                                    <td>{{ $machine->area->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col">
                <div class="card">
                    <div class="card-header text-bg-dark fw-bold" data-bs-toggle="collapse" href="#createMachine"
                        aria-expanded="false" aria-controls="createMachine">
                        Nueva Máquina
                    </div>
                    <div class="card-body collapse" id="createMachine">
                        <form method="POST" action="{{ route('machines.store') }}">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre de la máquina</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Área</label>
                                <select name="area_id" class="form-select select2" required>
                                    <option value="" disabled selected>-- Selecciona --</option>
                                    @foreach ($areas as $area)
                                        <option value="{{ $area->id }}"
                                            {{ old('area_id') == $area->id ? 'selected' : '' }}>
                                            {{ $area->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="text-end">
                                <x-primary-button>Guardar</x-primary-button>
                            </div>

                        </form>
                    </div>
                </div>

                <div class="col sticky-top z-10">
                    <div id="editCard" class="card mt-3 d-none">
                        <div class="card-header text-bg-dark fw-bold">Editar Máquina</div>
                        <div class="card-body">
                            <form id="editForm" method="POST">
                                @csrf
                                @method('PUT')

                                <div class="mb-3">
                                    <label for="machineName" class="form-label">Nombre</label>
                                    <input type="text" id="machineName" name="name" class="form-control" required>
                                </div>

                                <div class="mb-3">
                                    <label for="machineArea" class="form-label">Área</label>
                                    <select id="machineArea" name="area_id" class="form-control select2" required>
                                        @foreach ($areas as $area)
                                            <option value="{{ $area->id }}">{{ $area->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="text-end">
                                    <x-danger-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', 'confirm-record-deletion')">Eliminar
                                        máquina</x-danger-button>

                                    <x-primary-button>Editar</x-primary-button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-modal name="confirm-record-deletion">
        <form id="deleteForm" method="POST" class="p-6">
            @csrf
            @method('DELETE')
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('¿Estás seguro de eliminar la máquina?') }}
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

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('searchInput');
            const table = document.getElementById('machineTable');
            const rows = table.querySelectorAll('tbody tr');

            input.addEventListener('input', function() {
                const search = this.value.toLowerCase();

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            });
        });

        document.querySelectorAll('#machineTable tbody tr').forEach(row => {
            row.addEventListener('click', function() {
                const id = this.dataset.id;
                const name = this.dataset.name;
                const area = this.dataset.area;

                // Mostrar la card
                document.getElementById('editCard').classList.remove('d-none');

                // Rellenar los inputs
                document.getElementById('machineName').value = name;
                document.getElementById('machineArea').value = area;

                // Cambiar la acción del formulario dinámicamente
                document.getElementById('editForm').action = `/machines/${id}`;
                document.getElementById('deleteForm').action = `/machines/${id}`;
            });
        });
    </script>

</x-app-layout>
