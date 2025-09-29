<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Status;
use App\Models\User;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TechnicianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenancesType = UserType::where('name', 'Maintenance')->value('id');

        // Cargamos técnicos con sus mantenimientos y el status de cada mantenimiento
        $technicians = User::where('user_type_id', $maintenancesType)->get();

        return view('technicians.index', compact('technicians'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, User $technician)
    {
        $startDate = $request->startDate ?? Carbon::now()->startOfMonth()->format('Y-m-d');
        $endDate = $request->endDate ?? Carbon::now()->endOfMonth()->format('Y-m-d');

        $maintenances = $technician->maintenances()
            ->when($startDate, fn($q) => $q->whereDate('date', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('date', '<=', $endDate))
            ->orderBy('date', 'desc')
            ->get();

        return view('Technicians.show', compact('technician', 'maintenances','startDate','endDate'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
