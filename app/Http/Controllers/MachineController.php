<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Machine;
use App\Models\Maintenance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MachineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::all();
        $areas = Area::all();

        return view('Machines.index', compact('machines', 'areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
        ]);

        try {
            DB::beginTransaction();

            $machine = Machine::create([
                'name' => $validated['name'],
                'area_id' => $validated['area_id'],
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Máquina creada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al crear: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'area_id' => 'required|exists:areas,id',
        ]);

        try {
            DB::beginTransaction();

            $machine->update([
                'name' => $validated['name'],
                'area_id' => $validated['area_id'],
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Máquina creada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al crear: ' . $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        try {
            DB::beginTransaction();

            $maintenance = Maintenance::where('machine_id', $machine->id)->value('id');

            if ($maintenance) {
                throw new \Exception('Máquina asignada en el mantenimiento no. ' . $maintenance);
            }

            $machine->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Máquina eliminada correctamente.');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors('Error al eliminar máquina: ' . $e->getMessage());
        }
    }
}
