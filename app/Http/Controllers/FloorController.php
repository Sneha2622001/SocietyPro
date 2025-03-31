<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Floor;
use App\Models\Building;

class FloorController extends Controller
{
    public function index()
    {
        $floors = Floor::with('building')->get();
        // $floors = Floor::all();
        // return $floors;
        return view('floors.index', compact('floors'));
    }

    public function create()
    {
        $buildings = Building::all();
        return view('floors.create', compact('buildings'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'floor_number' => 'required|integer|min:1'
        ]);

        Floor::create($request->all());

        return redirect()->route('floor.index')->with('success', 'Floor added successfully!');
    }

    public function edit(Floor $floor)
    {
        $buildings = Building::all();
        return view('floors.edit', compact('floor', 'buildings'));
    }

    public function update(Request $request, Floor $floor)
    {
        $request->validate([
            'building_id' => 'required|exists:buildings,id',
            'floor_number' => 'required|integer|min:1'
        ]);

        $floor->update($request->all());

        return redirect()->route('floor.index')->with('success', 'Floor updated successfully!');
    }

    public function destroy(Floor $floor)
    {
        $floor->delete();
        return redirect()->route('floor.index')->with('success', 'Floor deleted successfully!');
    }
}