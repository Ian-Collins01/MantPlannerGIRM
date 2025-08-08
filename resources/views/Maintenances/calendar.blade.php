<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Calendario') }}
        </h2>
    </x-slot>

    <div class="container mt-2">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('maintenances.calendar', [$currentDate->copy()->subMonth()->year, $currentDate->copy()->subMonth()->month]) }}">
                        <x-primary-button>← Mes anterior</x-primary-button>
                    </a>

                    <h3>{{ $currentDate->isoFormat('MMMM YYYY') }}</h3>


                    <a href="{{ route('maintenances.calendar', [$currentDate->copy()->addMonth()->year, $currentDate->copy()->addMonth()->month]) }}">
                        <x-primary-button>Mes siguiente →</x-primary-button>
                    </a>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="table-secondary">
                            <tr>
                                @foreach (['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'] as $day)
                                    <th>{{ $day }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $start = $currentDate->copy()->startOfMonth()->startOfWeek(Carbon\Carbon::SUNDAY);
                                $end = $currentDate->copy()->endOfMonth()->endOfWeek(Carbon\Carbon::SATURDAY);
                            @endphp

                            @for ($date = $start; $date <= $end; $date->addDay())
                                @if ($date->dayOfWeek === Carbon\Carbon::SUNDAY)
                                    <tr>
                                @endif

                                <td class="{{ $date->month !== $currentDate->month ? 'bg-light text-muted' : '' }}">
                                    <strong>{{ $date->day }}</strong>

                                    @foreach ($maintenances->get($date->format('Y-m-d'), []) as $maintenance)
                                        <a href="{{ route('maintenances.show', $maintenance) }}">
                                            <div class="badge bg-secondary d-block text-start mt-1">
                                                {{ $maintenance->machine->name }}<br>
                                                <small>{{ $maintenance->technician->name ?? '-- No Asignado --' }}</small>
                                            </div>
                                        </a>
                                    @endforeach
                                </td>

                                @if ($date->dayOfWeek === Carbon\Carbon::SATURDAY)
                                    </tr>
                                @endif
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
