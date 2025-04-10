<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Resident;
use App\Models\Unit;
use App\Models\User;

class ResidentController extends Controller
{
    public function index()
    {
        $residents = Resident::with(['user', 'unit'])->latest()->paginate(10);
        return view('residents.index', compact('residents'));
    }

    public function edit($id)
    {
        $resident = Resident::findOrFail($id);
        $units = Unit::all(); // All units available to assign
        return view('residents.edit', compact('resident', 'units'));
    }

    public function update(Request $request, $id)
    {
        $resident = Resident::findOrFail($id);
        $resident->update([
            'unit_id' => $request->unit_id,
            'name' => $request->name,
            'contact' => $request->contact,
        ]);

        return redirect()->route('residents.index')->with('success', 'Resident updated successfully.');
    }

    public function destroy($id)
    {
        Resident::destroy($id);
        return redirect()->route('residents.index')->with('success', 'Resident deleted successfully.');
    }
}
