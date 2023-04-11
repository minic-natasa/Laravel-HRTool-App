<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //displays a list of all organizations
        $organizations = Organization::all();
        return view('organizations.index', compact('organizations'));
    }

    public function organization_card(string $id)
    {
        $organization = Organization::find($id);
        return view('organizations.organization-card', compact('organization'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Retrieve all users who are managers
        $managers = User::where('manager', 1)->get();

        //displays a form for creating a new organization
        $organizations = Organization::all();

        return view('organizations.create', compact('managers', 'organizations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|max:255',
            'parent_id' => 'nullable|exists:organizations,id',
            'manager_id' => 'nullable|exists:users,id',
        ]);

        // Create the new organization
        $organization = new Organization([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            'manager_id' => $request->input('manager_id'),
        ]);
        $organization->save();

        // Redirect to the index page with a success message
        return redirect()->route('organizations.index')
            ->with('success', 'Organization created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Retrieve the organization with the given ID from the database
        $organization = Organization::findOrFail($id);

        //displays a form for editing an existing organization
        $organizations = Organization::all();

        // Retrieve all users who are managers
        $managers = User::where('manager', 1)->get();

        // Retrieve all contracts from managers
        //$contracts = Contract::whereIn('user_id', $managers->pluck('id'))->get();

        //Retrieve all contracts from DB
        $contracts = Contract::all();

        return view('organizations.edit', compact('organization', 'organizations', 'managers', 'contracts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organization $organization)
    {
        $organization->update($request->all());

        if ($request->has('parent_id')) {
            $parent = Organization::find($request->input('parent_id'));
            $organization->parent()->associate($parent);
        } else {
            $organization->parent()->dissociate();
        }

        $organization->save();

        return redirect()->route('organizations.index')->with('success', 'Organization updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        return redirect()->route('organizations.index')->with('success', 'Organization deleted successfully!');
    }
}
