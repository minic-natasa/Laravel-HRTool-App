<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $positions = Position::all();
        return view('positions.index', ['positions' => $positions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $organizations = Organization::all();
        return view('positions.create', compact('organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization_id' => 'required|exists:organizations,id',
            'professional_qualifications_level'  => 'required|string',
            'professional_requirements_per_job_systematisation'  => 'required|string',
        ]);

        $position = new Position([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'organization_id' => $request->input('organization_id'),
            'professional_qualifications_level' => $request->input('professional_qualifications_level'),
            'professional_requirements_per_job_systematisation' => $request->input('professional_requirements_per_job_systematisation'),
        ]);
        $position->save();

        return redirect()->route('positions.index')
            ->with('success', 'Position created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $position = Position::find($id);
        $organizations = Organization::all();

        return view('positions.edit', compact('position', 'organizations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'organization_id' => 'required|exists:organizations,id',
            'professional_qualifications_level'  => 'required',
            'professional_requirements_per_job_systematisation'  => 'required',
        ]);

        $position = Position::find($id);
        $position->name = $request->input('name');
        $position->description = $request->input('description');
        $position->organization_id = $request->input('organization_id');
        $position->professional_qualifications_level = $request->input('professional_qualifications_level');
        $position->professional_requirements_per_job_systematisation = $request->input('professional_requirements_per_job_systematisation');

        $position->save();

        return redirect()->route('positions.index')->with('success', 'Position updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $position = Position::find($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success', 'Position deleted successfully!');
    }

    public function getByOrganization(Request $request)
    {
        $positions = Position::where('organization_id', $request->organization_id)->get();

        return response()->json([
            'positions' => $positions
        ]);
    }
}
