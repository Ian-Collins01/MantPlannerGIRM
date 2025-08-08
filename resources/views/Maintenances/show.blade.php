<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de Mantenimiento #') }}{{ $maintenance->id }}

                <span class="badge {{ $badgeColor }}">
                    {{ $maintenance->status->description }}
                </span>
            </h2>
            <div>
                <a
                    href="{{ route(
                        Auth::user()->userType->name === 'Comun' ? 'maintenances.edit_ticket' : 'maintenances.edit',
                        $maintenance,
                    ) }}">
                    <x-primary-button>Editar</x-primary-button>
                </a>
            </div>
        </div>

    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col">

                <div class="card mb-2">
                    <div class="card-header text-bg-dark fw-bold">
                        Datos del Mantenimiento
                    </div>
                    <div class="card-body">
                        <div class="row d-flex justify-end">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">Fecha</label>
                                <input type="text" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($maintenance->date)->format('d/m/Y') }}" disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">Hora Aviso</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->notice_hour ? \Carbon\Carbon::parse($maintenance->notice_hour)->format('H:i') : '---' }}"
                                    disabled>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label">Hora Inicio</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->start_hour ? \Carbon\Carbon::parse($maintenance->start_hour)->format('H:i') : '---' }}"
                                    disabled>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label">Hora Fin</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->end_hour ? \Carbon\Carbon::parse($maintenance->end_hour)->format('H:i') : '---' }}"
                                    disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label class="form-label">Tiempo de Respuesta</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->response_time ? round($maintenance->response_time, 0) . ' min' : '---' }}"
                                    disabled>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label">Tiempo de Mantenimiento</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->maintenance_time ? round($maintenance->maintenance_time, 0) . ' min' : '---' }} "
                                    disabled>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-2">
                                <label class="form-label">Máquina</label>
                                <input type="text" class="form-control" value="{{ $maintenance->machine->name }}"
                                    disabled>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label">Técnico</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->technician->name ?? '-- No Asignado --' }}" disabled>
                            </div>

                            <div class="col-md-4 mb-2">
                                <label class="form-label">Aplicante</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->applicant->name ?? '-- No Definido --' }}" disabled>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label d-block">Tipo de Mantenimiento</label>
                                <input type="text" class="form-control"
                                    value="{{ $maintenance->maintenanceType->name }}" disabled>
                            </div>

                            <div class="col-md-6 mb-2">
                                <label class="form-label d-block">¿Hubo Paro?</label>
                                <div class="border rounded p-3 bg-light">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" disabled
                                            {{ $maintenance->has_stoppage ? 'checked' : '' }}>
                                        <label class="form-check-label">Sí</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" disabled
                                            {{ !$maintenance->has_stoppage ? 'checked' : '' }}>
                                        <label class="form-check-label">No</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mb-2">
                                <label class="form-label">Descripción</label>
                                <textarea rows="4" class="form-control" disabled>{{ $maintenance->description }}</textarea>
                            </div>

                            <div class="text-end">
                                <a
                                    href="{{ route('maintenances.index', "start_date=$maintenance->date&end_date=$maintenance->date") }}">
                                    <x-secondary-button>Regresar</x-secondary-button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (Auth::user()->userType->name != 'Comun')
                <div class="col">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Actividades del Mantenimiento
                        </div>
                        <div class="card-body p-0">
                            @foreach ($groupedTasks as $headerName => $tasks)
                                <div class="border-bottom px-3 py-2 bg-light fw-bold">
                                    {{ $headerName }}
                                </div>
                                <table class="table table-bordered table-sm mb-0">
                                    <tbody>
                                        @foreach ($tasks as $task)
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="form-check-input toggle-task"
                                                        data-task-id="{{ $task->id }}"
                                                        {{ $task->completed ? 'checked' : '' }}>
                                                </td>
                                                <td>{{ $task->task_description }}</td>
                                                <td>
                                                    <input type="text"
                                                        class="form-control form-control-sm note-input"
                                                        value="{{ $task->notes }}" data-task-id="{{ $task->id }}"
                                                        id="note_{{ $task->id }}" placeholder="-- Notas --">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>

    <script>
        const maintenanceId = "{{ $maintenance->id }}";
        const csrfToken = "{{ csrf_token() }}";

        function updateTask(taskId, completed, notes) {
            fetch(`/maintenances/${maintenanceId}/tasks/${taskId}`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    completed: completed,
                    notes: notes
                })
            }).then(res => {
                if (!res.ok) throw new Error("Error al actualizar");
            }).catch(err => {
                alert("Error al actualizar la tarea.");
            });
        }

        document.querySelectorAll('.toggle-task').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const taskId = this.dataset.taskId;
                const completed = this.checked;
                const notes = document.querySelector(`#note_${taskId}`).value;

                updateTask(taskId, completed, notes);
            });
        });

        document.querySelectorAll('.note-input').forEach(textarea => {
            textarea.addEventListener('blur', function() {
                const taskId = this.dataset.taskId;
                const completed = document.querySelector(`.toggle-task[data-task-id="${taskId}"]`).checked;
                const notes = this.value;

                updateTask(taskId, completed, notes);
            });
        });
    </script>

</x-app-layout>
