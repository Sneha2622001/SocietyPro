<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Resident;
use App\Models\Unit;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with('unit')->get();
        return view('residents.index', compact('residents'));
    }

    public function create()
    {
        $units = Unit::all();
        return view('residents.create', compact('units'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
        ]);

        Resident::create($request->all());

        return redirect()->route('residents.index')->with('success', 'Resident added successfully!');
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        $units = Unit::all();
        return view('residents.edit', compact('resident', 'units'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'unit_id' => 'required|exists:units,id',
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:15',
        ]);

        $resident = Resident::findOrFail($id);
        $resident->update($request->all());

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully!');
    }

    public function destroy($id)
    {
        $resident = Resident::findOrFail($id);
        $resident->delete();

        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully!');
    }
}