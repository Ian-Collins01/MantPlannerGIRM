<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Crear Listado de Actividades
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('task-headers.store') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label h5 text-bg-dark">Nombre del Encabezado</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label h5 text-bg-dark">Actividades</label>
                        <div id="task-list">
                            @if (old('tasks'))
                                @foreach (old('tasks') as $index => $task)
                                    <div class="input-group mb-2">
                                        <input type="text" name="tasks[{{ $index }}][description]"
                                            class="form-control" value="{{ $task['description'] ?? '' }}" required>
                                        <button type="button" class="btn btn-danger remove-task">Eliminar</button>
                                    </div>
                                @endforeach
                            @else
                                <div class="input-group mb-2">
                                    <input type="text" name="tasks[0][description]" class="form-control"
                                        placeholder="Nueva actividad" required>
                                </div>
                            @endif
                        </div>
                        <x-secondary-button id="add-task">Agregar Actividad</x-secondary-button>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('task-headers.index') }}">
                            <x-secondary-button>Cancelar</x-secondary-button>
                        </a>
                        <x-primary-button>Guardar</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        let taskIndex = {{ old('tasks') ? count(old('tasks')) : 1 }};

        document.getElementById('add-task').addEventListener('click', function() {
            const taskList = document.getElementById('task-list');
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('input-group', 'mb-2');

            inputGroup.innerHTML = `
                <input type="text" name="tasks[${taskIndex}][description]" class="form-control"
                    placeholder="Nueva actividad" required>
                <x-danger-button class="remove-task">Eliminar</x-danger-button>
            `;

            taskList.appendChild(inputGroup);
            taskIndex++;
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-task')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
</x-app-layout>
