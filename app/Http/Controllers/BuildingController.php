<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Building;

class BuildingController extends Controller
{
    function index() {
        $buildings = Building::all();
        return view('buildings.index', compact('buildings'));
        // return view('buildings.index');
       
    }

    function create() {
        return view('buildings.create');
    }

    function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:250',
            'address' => 'required|string|max:255',
        ]);

        Building::create([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        return redirect()->route('building')->with('success', 'Building added successfully.');
    }

    function edit($id) {
        $building = Building::findOrFail($id);
        return view('buildings.edit', compact('building'));
    }

    function update(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:250',
            'address' => 'required|string|max:255',
        ]);

        $building = Building::findOrFail($id);
        $building->update([
            'name' => $request->name,
            'address' => $request->address,
        ]);

        // return redirect()->route('building')->with('success', 'Building updated successfully.');
        return redirect('/building')->with('success', 'Building updated successfully.');

    }

    function destroy($id) {
        $building = Building::findOrFail($id);
        $building->delete();

        return redirect()->route('building')->with('success', 'Building deleted successfully.');
    }
}
