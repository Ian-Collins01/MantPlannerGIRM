<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Listado de Actividades #{{$taskHeader->id}}
        </h2>
    </x-slot>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('task-headers.update', $taskHeader) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="name" class="form-label h5 text-bg-dark">Nombre del Encabezado</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $taskHeader->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label h5 text-bg-dark">Actividades</label>
                        <div id="task-list">
                            @foreach ($taskHeader->tasks as $task)
                                <div class="input-group mb-2">
                                    <input type="text" name="tasks[]" class="form-control"
                                        value="{{ $task->description }}" required>
                                    <x-danger-button class="remove-task">Eliminar</x-danger-button>
                                </div>
                            @endforeach
                        </div>
                        <x-secondary-button id="add-task"> Agregar Actividad</x-secondary-button>
                    </div>

                    <div class="text-end">
                        <a href="{{ route('task-headers.index') }}">
                            <x-secondary-button>Cancelar</x-secondary-button>
                        </a>
                        <x-primary-button>Guardar Cambios</x-primary-button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('add-task').addEventListener('click', function() {
            const taskList = document.getElementById('task-list');
            const inputGroup = document.createElement('div');
            inputGroup.classList.add('input-group', 'mb-2');
            inputGroup.innerHTML = `
                <input type="text" name="tasks[]" class="form-control" placeholder="Nueva actividad" required>
                <x-danger-button class="remove-task">Eliminar</x-danger-button>
            `;
            taskList.appendChild(inputGroup);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-task')) {
                e.target.closest('.input-group').remove();
            }
        });
    </script>
</x-app-layout>
