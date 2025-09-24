<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\MaintenanceTask;
use App\Models\TaskHeader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskHeaderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $taskHeaders = TaskHeader::all();

        return view('TaskHeaders.index', compact('taskHeaders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('TaskHeaders.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tasks' => 'required|array|min:1',
            'tasks.*.description' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            $taskHeader = TaskHeader::create([
                'name' => $validated['name'],
            ]);

            foreach ($validated['tasks'] as $taskData) {
                $taskHeader->tasks()->create([
                    'description' => $taskData['description'],
                ]);
            }

            DB::commit();

            return redirect()->route('task-headers.index')->with('success', 'Encabezado creado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al guardar: ' . $e->getMessage())->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(TaskHeader $TaskHeader)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskHeader $taskHeader)
    {
        $taskHeader->load('tasks');

        return view('TaskHeaders.edit', compact('taskHeader'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskHeader $taskHeader)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'tasks' => 'nullable|array',
            'tasks.*' => 'required|string|max:255',
        ]);

        try {
            DB::beginTransaction();

            // 1. Actualizar nombre
            $taskHeader->update([
                'name' => $validated['name'],
            ]);

            // 2. Eliminar tareas existentes
            $taskHeader->tasks()->delete();

            // 3. Insertar nuevas tareas
            if (!empty($validated['tasks'])) {
                foreach ($validated['tasks'] as $description) {
                    $taskHeader->tasks()->create([
                        'description' => $description,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('task-headers.index')->with('success', 'Encabezado actualizado correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Ocurrió un error al actualizar: ' . $e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskHeader $taskHeader)
    {
        try {
            DB::beginTransaction();

            $maintenance = MaintenanceTask::where('task_header_id',$taskHeader->id)->value('maintenance_id');

            if ($maintenance) {
                throw new \Exception('Lista de actividades asignada en el mantenimiento no. ' . $maintenance);
            }

            $taskHeader->delete();

            DB::commit();
            return redirect()->route('task-headers.index')->with('success', 'Lista de actividades eliminada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al eliminar lista de actividades: ' . $e->getMessage());
        }
    }
}
