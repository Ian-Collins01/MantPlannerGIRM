<?php

namespace App\Http\Controllers;

use App\Models\Machine;
use App\Models\Maintenance;
use App\Models\MaintenanceTask;
use App\Models\Task;
use App\Models\TaskHeader;
use App\Models\MaintenanceType;
use App\Models\Status;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Maintenance::with(['machine', 'technician', 'maintenanceType']);

        $start_date = $request->input('start_date') ?? Carbon::now()->toDateString();
        $end_date = $request->input('end_date') ?? Carbon::now()->toDateString();

        $query->whereBetween('date', [$start_date, $end_date]);

        if ($request->has('maintenance_type_ids') && is_array($request->maintenance_type_ids)) {
            $query->whereIn('maintenance_type', $request->maintenance_type_ids);
        }

        if (Auth::user()->userType->name === 'Comun') {
            $query->where('applicant_id', Auth::user()->id);
        }

        $maintenances = $query->orderBy('date')->get();
        $maintenanceTypes = MaintenanceType::all();

        return view('maintenances.index', compact('maintenances', 'maintenanceTypes', 'start_date', 'end_date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $comunUserTypeId = UserType::where('name', 'Comun')->value('id');

        $machines = Machine::all();
        $technicians = User::where('user_type_id', '<>', $comunUserTypeId)->get();
        $applicants = User::where('user_type_id', $comunUserTypeId)->get();
        $types = MaintenanceType::all();
        $taskHeaders = TaskHeader::all();

        return view('maintenances.create', compact('machines', 'technicians', 'applicants', 'types', 'taskHeaders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'notice_hour' => 'nullable|date_format:H:i',
            'start_hour' => 'nullable|date_format:H:i',
            'end_hour' => 'nullable|date_format:H:i',
            'description' => 'required|string',
            'has_stoppage' => 'nullable|boolean',
            'machine_id' => 'required|exists:machines,id',
            'technician_id' => 'nullable|exists:users,id',
            'applicant_id' => 'nullable|exists:users,id',
            'maintenance_type' => 'required|exists:maintenance_types,id',
            'task_header_id' => 'nullable|array',
            'task_header_id.*' => 'exists:task_headers,id',
            'repeat_interval' => 'nullable|in:monthly,semiannually,annually',
        ]);

        try {
            DB::beginTransaction();

            $repeatCount = match ($validated['repeat_interval'] ?? null) {
                'monthly' => 12,
                'semiannually' => 2,
                default => 1,
            };

            $createdMaintenances = [];

            for ($i = 0; $i < $repeatCount; $i++) {
                $date = Carbon::parse($validated['date'])->addMonths($i * match ($validated['repeat_interval'] ?? null) {
                    'monthly' => 1,
                    'semiannually' => 6,
                    default => 0,
                });

                //Saltar sábados y domingos
                while ($date->isWeekend()) {
                    $date->addDay(); // Mueve al siguiente día hábil
                }

                $noticeHour = isset($validated['notice_hour']) ? Carbon::parse($validated['notice_hour']) : null;
                $startHour = isset($validated['start_hour']) ? Carbon::parse($validated['start_hour']) : null;
                $endHour = isset($validated['end_hour']) ? Carbon::parse($validated['end_hour']) : null;
                $hasStoppage = isset($validated['has_stoppage']) ? $validated['has_stoppage'] : 0;
                $technicianId = isset($validated['technician_id']) ? $validated['technician_id'] : null;
                $applicantId = isset($validated['applicant_id']) ? $validated['applicant_id'] : null;

                $responseTime = ($noticeHour && $startHour) ? $noticeHour->diffInMinutes($startHour) : null;
                $maintenanceTime = ($startHour && $endHour) ? $startHour->diffInMinutes($endHour) : null;

                $statusNewId = Status::where('description', 'Nuevo')->value('id');

                $maintenance = Maintenance::create([
                    'date' => $date->toDateString(),
                    'notice_hour' => $validated['notice_hour'] ?? null,
                    'start_hour' => $validated['start_hour'] ?? null,
                    'end_hour' => $validated['end_hour'] ?? null,
                    'response_time' => $responseTime,
                    'maintenance_time' => $maintenanceTime,
                    'description' => $validated['description'],
                    'has_stoppage' => $hasStoppage,
                    'machine_id' => $validated['machine_id'],
                    'technician_id' => $technicianId,
                    'applicant_id' => $applicantId,
                    'maintenance_type' => $validated['maintenance_type'],
                    'status_id' => $statusNewId,
                ]);

                if (isset($validated['task_header_id'])) {
                    $taskHeaders = TaskHeader::with('tasks')->whereIn('id', $validated['task_header_id'])->get();

                    foreach ($taskHeaders as $taskHeader) {
                        foreach ($taskHeader->tasks as $task) {
                            $maintenance->maintenanceTasks()->create([
                                'task_description' => $task->description,
                                'completed' => false,
                                'notes' => null,
                                'task_header_id' => $taskHeader->id,
                            ]);
                        }
                    }
                }

                $createdMaintenances[] = $maintenance;
            }


            DB::commit();

            return redirect()->route('maintenances.show', $createdMaintenances[0])
                ->with('success', 'Mantenimiento(s) registrado(s) correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al registrar mantenimiento: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        $maintenance->load([
            'machine.area',
            'technician',
            'applicant',
            'maintenanceType',
            'maintenanceTasks' => function ($query) {
                $query->with('header');
            },
        ]);

        $groupedTasks = collect($maintenance->maintenanceTasks)->groupBy(function ($task) {
            return $task->header->name ?? 'Sin encabezado';
        });

        $badgeColor = Status::badgeColor($maintenance->status->id);

        return view('maintenances.show', compact('maintenance', 'groupedTasks', 'badgeColor'));
    }


    public function updateTask(Request $request, Maintenance $maintenance, $taskId)
    {
        try {
            $task = $maintenance->maintenanceTasks()->where('id', $taskId)->firstOrFail();

            $task->completed = $request->input('completed', false);
            $task->notes = $request->input('notes');
            $task->save();

            return response()->json(['message' => 'Tarea actualizada']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error al actualizar la tarea'], 500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        $comunUserTypeId = UserType::where('name', 'Comun')->value('id');

        $machines = Machine::all();
        $technicians = User::where('user_type_id', '<>', $comunUserTypeId)->get();
        $applicants = User::where('user_type_id', $comunUserTypeId)->get();
        $types = MaintenanceType::all();
        $taskHeaders = TaskHeader::all();

        // Obtener IDs únicos de los task headers usados por las tareas actuales
        $selectedTaskHeaders = $maintenance->maintenanceTasks()
            ->pluck('task_header_id')
            ->unique()
            ->filter()  // Opcional: elimina nulls si hay task_header_id nulos
            ->values()  // Reindexar el array
            ->toArray();


        return view('maintenances.edit', compact('maintenance', 'machines', 'technicians', 'applicants', 'types', 'taskHeaders', 'selectedTaskHeaders'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        $validated = $request->validate([
            'date' => 'required|date',
            'notice_hour' => 'nullable|date_format:H:i',
            'start_hour' => 'nullable|date_format:H:i',
            'end_hour' => 'nullable|date_format:H:i',
            'description' => 'required|string',
            'has_stoppage' => 'nullable|boolean',
            'machine_id' => 'required|exists:machines,id',
            'technician_id' => 'nullable|exists:users,id',
            'applicant_id' => 'nullable|exists:users,id',
            'maintenance_type' => 'required|exists:maintenance_types,id',
            'task_header_id' => 'nullable|array',
            'task_header_id.*' => 'exists:task_headers,id',
        ]);

        try {
            DB::beginTransaction();

            $noticeHour = isset($validated['notice_hour']) ? Carbon::parse($validated['notice_hour']) : null;
            $startHour = isset($validated['start_hour']) ? Carbon::parse($validated['start_hour']) : null;
            $endHour = isset($validated['end_hour']) ? Carbon::parse($validated['end_hour']) : null;
            $hasStoppage = isset($validated['has_stoppage']) ? $validated['has_stoppage'] : 0;
            $technicianId = isset($validated['technician_id']) ? $validated['technician_id'] : null;
            $applicantId = isset($validated['applicant_id']) ? $validated['applicant_id'] : null;

            $responseTime = ($noticeHour && $startHour) ? $noticeHour->diffInMinutes($startHour) : null;
            $maintenanceTime = ($startHour && $endHour) ? $startHour->diffInMinutes($endHour) : null;

            // Actualizar datos del mantenimiento
            $maintenance->update([
                'date' => $validated['date'],
                'notice_hour' => $validated['notice_hour'] ?? null,
                'start_hour' => $validated['start_hour'] ?? null,
                'end_hour' => $validated['end_hour'] ?? null,
                'response_time' => $responseTime,
                'maintenance_time' => $maintenanceTime,
                'description' => $validated['description'],
                'has_stoppage' => $hasStoppage,
                'machine_id' => $validated['machine_id'],
                'technician_id' => $technicianId,
                'applicant_id' => $applicantId,
                'maintenance_type' => $validated['maintenance_type'],
            ]);

            if (Auth::user()->userType->name != 'Comun') {
                // Obtener los task_header_ids actuales en maintenanceTasks
                $currentHeaderIds = $maintenance->maintenanceTasks()->pluck('task_header_id')->unique()->filter()->values()->toArray();

                $newHeaderIds = isset($validated['task_header_id']) ? collect($validated['task_header_id'])->unique()->values()->toArray() : [];

                // Detectar qué headers se agregaron y cuáles se eliminaron
                $toRemove = array_diff($currentHeaderIds, $newHeaderIds);
                $toAdd = array_diff($newHeaderIds, $currentHeaderIds);

                // Eliminar tareas cuyo task_header_id ya no está en la selección
                if (count($toRemove) > 0) {
                    $maintenance->maintenanceTasks()->whereIn('task_header_id', $toRemove)->delete();
                }

                // Agregar tareas nuevas para los task_header_id nuevos
                if (count($toAdd) > 0) {
                    $taskHeadersToAdd = TaskHeader::with('tasks')->whereIn('id', $toAdd)->get();

                    foreach ($taskHeadersToAdd as $taskHeader) {
                        foreach ($taskHeader->tasks as $task) {
                            $maintenance->maintenanceTasks()->create([
                                'task_description' => $task->description,
                                'completed' => false,
                                'notes' => null,
                                'task_header_id' => $taskHeader->id,
                            ]);
                        }
                    }
                }
            }

            DB::commit();

            return redirect()->route('maintenances.show', $maintenance)
                ->with('success', 'Mantenimiento actualizado correctamente.');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al actualizar mantenimiento: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Maintenance $maintenance)
    {
        try {
            DB::beginTransaction();

            $maintenance->delete();

            DB::commit();
            return redirect()->route('maintenances.index')->with('success', 'Mantenimiento eliminado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al eliminar mantenimiento: ' . $e->getMessage());
        }
    }

    public function calendar($year = null, $month = null)
    {
        Carbon::setLocale('es');
        $date = Carbon::createFromDate($year, $month, 1)->startOfMonth();

        $maintenances = Maintenance::with(['machine', 'technician'])
            ->whereMonth('date', $date->month)
            ->whereYear('date', $date->year)
            ->get()
            ->groupBy(function ($item) {
                return $item->date;
            });

        return view('maintenances.calendar', [
            'currentDate' => $date,
            'maintenances' => $maintenances,
        ]);
    }

    public function ticket()
    {
        $machines = Machine::all();
        $technicians = User::all();
        $types = MaintenanceType::all();
        $taskHeaders = TaskHeader::all();

        return view('maintenances.ticket', compact('machines', 'technicians', 'types', 'taskHeaders'));
    }

    public function editTicket(Maintenance $maintenance)
    {
        $machines = Machine::all();

        return view('Maintenances.edit_ticket', compact('maintenance', 'machines'));
    }
}
