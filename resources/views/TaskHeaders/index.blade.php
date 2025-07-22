<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Lista de Actividades') }}
            </h2>
            <div>
                <a href="{{ route('task-headers.create') }}">
                    <x-primary-button>Nueva Lista</x-primary-button>
                </a>
            </div>
        </div>
    </x-slot>

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-5">
                <div class="card mb-3">
                    <div class="card-body">
                        <input type="text" id="searchInput" class="form-control" placeholder="Buscar en la tabla...">
                    </div>
                </div>
            </div>
        </div>
        <div class="card table-responsive">
            <table class="table table-bordered table-hover" id="taskTable">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>No. de Actividades</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($taskHeaders as $header)
                        <tr onclick="window.location='{{ route('task-headers.edit', $header) }}';"
                            style="cursor: pointer;">
                            <td>{{ $header->name }}</td>
                            <td>{{ $header->tasks->count('id') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('searchInput');
            const table = document.getElementById('taskTable');
            const rows = table.querySelectorAll('tbody tr');

            input.addEventListener('input', function() {
                const search = this.value.toLowerCase();

                rows.forEach(row => {
                    const text = row.textContent.toLowerCase();
                    row.style.display = text.includes(search) ? '' : 'none';
                });
            });
        });
    </script>

</x-app-layout>
