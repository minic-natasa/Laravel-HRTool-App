<?php

namespace App\Http\Controllers;

use App\Models\Annex;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\User;
use App\Models\Manager;

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
        $contracts = Contract::all();
        $organizations = Organization::all();
        $organization = Organization::find($id);
        return view('organizations.organization-card', compact('organization', 'organizations', 'contracts'));
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
            //'manager_id' => 'nullable|exists:users,id',
            'manager_id' => 'nullable',
        ]);

        // Create the new organization
        $organization = new Organization([
            'name' => $request->input('name'),
            'parent_id' => $request->input('parent_id'),
            //'manager_id' => $request->input('manager_id'),
            'manager_id' => null, // set manager_id to null
        ]);
        $organization->save();

        $notification = array(
            'message' => 'Organization created successfully!',
            'alert-type' => 'success'
        );

        // Redirect to the index page with a success message
        return redirect()->route('organizations.index')->with($notification);
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

        // Get active managers for this organization
        // Get active managers from contracts without annexes

        $hasAnnex = Annex::whereIn('contract_id', function ($query) use ($organization) {
            $query->select('id')
                ->from('contracts')
                ->where('organization_id', $organization->id)
                ->where('status', 'active');
        })
            ->whereRaw("FIND_IN_SET('Promena pozicije', reason) > 0")
            ->where('deleted', 0)
            ->exists();

        $activeManagers = User::where('manager', 1)
            ->whereHas('contract', function ($query) use ($organization) {
                $query->where('organization_id', $organization->id)
                    ->where('status', 'active');
            })->get();

        // Get active managers from contracts with annexes
        $annexActiveManagers = User::where('manager', 1)
            ->whereIn('id', function ($query) use ($organization) {
                $query->select('employee_number')
                    ->from('contracts')
                    ->where('organization_id', $organization->id)
                    ->where('status', 'active')
                    ->whereIn('id', function ($subQuery) {
                        $subQuery->select('contract_id')
                            ->from('annexes')
                            ->whereRaw("FIND_IN_SET('Promena pozicije', reason) > 0")
                            ->where('deleted', 0)
                            ->orderByDesc('annex_date');
                    });
            })
            ->get();

        // Merge the active managers and annex active managers
        $allActiveManagers = $activeManagers->concat($annexActiveManagers);

        // Now you can use $allActiveManagers for your desired output


        // Retrieve all contracts from managers
        //$contracts = Contract::whereIn('user_id', $managers->pluck('id'))->get();

        //Retrieve all contracts from DB
        $contracts = Contract::all();

        return view('organizations.edit', compact('organization', 'organizations', 'managers', 'contracts', 'allActiveManagers'));
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

        $notification = array(
            'message' => 'Organization updated successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('organizations.organization-card', $organization->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organization $organization)
    {
        $organization->delete();

        $notification = array(
            'message' => 'Organization deleted successfully!',
            'alert-type' => 'success'
        );

        return redirect()->route('organizations.index')->with($notification);
    }

    public function showForm(string $organizationId)
    {
        $organization = Organization::findOrFail($organizationId);

        // Retrieve all managers who have an organization with the given ID
        $managers = Manager::whereHas('organizations', function ($query) use ($organizationId) {
            $query->where('id', $organizationId);
        })->get();

        // Retrieve all managers who have an active contract with the given organization
        $activeManagers = collect();
        foreach ($managers as $manager) {
            foreach ($manager->contracts as $contract) {
                if ($contract->active && $contract->organization_id == $organizationId) {
                    $activeManagers->push($manager);
                    break;
                }
            }
        }

        return view('organizations.edit', [
            'organization' => $organization,
            'activeManagers' => $activeManagers
        ]);
    }
}
