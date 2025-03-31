<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Floor;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::with('floor')->get();
        return view('units.index', compact('units'));
    }

    public function create()
    {
        $floors = Floor::all();
        return view('units.create', compact('floors'));
    }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'floor_id' => 'required|exists:floors,id',
    //         'unit_number' => 'required|string|max:255|unique:units,unit_number',
    //         'unit_type' => 'required|string|max:255',
    //         'size' => 'nullable|integer',
    //     ]);

    //     Unit::create($request->all());

    //     return redirect()->route('units.index')->with('success', 'Unit added successfully!');
    // }

    public function store(Request $request)
{
    $request->validate([
        'floor_id' => 'required|exists:floors,id',
        'unit_number' => 'required|integer|unique:units,unit_number,NULL,id,floor_id,' . $request->floor_id,
        'size' => 'nullable|integer',
    ], [
        'unit_number.unique' => 'This unit number already exists on the selected floor.',
    ]);

    Unit::create([
        'floor_id' => $request->floor_id,
        'unit_number' => $request->unit_number,
        'size' => $request->size,
        'unit_type' => $request->unit_type,
    ]);

    return redirect()->route('units.index')->with('success', 'Unit added successfully!');
}


    public function edit(Unit $unit)
    {
        $floors = Floor::all();
        return view('units.edit', compact('unit', 'floors'));
    }

    public function update(Request $request, Unit $unit)
    {
        $request->validate([
            'floor_id' => 'required|exists:floors,id',
            'unit_number' => "required|string|max:255|unique:units,unit_number,$unit->id",
            'unit_type' => 'required|string|max:255',
            'size' => 'nullable|integer',
        ]);

        $unit->update($request->all());

        return redirect()->route('units.index')->with('success', 'Unit updated successfully!');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        return redirect()->route('units.index')->with('success', 'Unit deleted successfully!');
    }
}
