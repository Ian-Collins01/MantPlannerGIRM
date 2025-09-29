<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Técnicos') }}
        </h2>
    </x-slot>

    <div class="container mt-4">
        {{-- Tabla de técnicos --}}
        <div class="mb-3">
            <div class="card mb-3">
                <div class="card-body d-flex gap-2 flex-wrap">
                    <input type="text" id="searchInput" class="form-control" placeholder="Buscar en la tabla...">
                </div>
            </div>

            <div class="card table-responsive">
                <table class="table table-bordered table-hover" id="technicianTable">
                    <thead class="table-dark">
                        <tr>
                            <th>No. empleado</th>
                            <th>Nombre</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($technicians as $technician)
                            <tr onclick="window.location='{{ route('technicians.show', $technician) }}';"
                                style="cursor: pointer;">
                                <td>{{ $technician->employee_number }}</td>
                                <td>{{ $technician->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const input = document.getElementById('searchInput');
            const table = document.getElementById('technicianTable');
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
