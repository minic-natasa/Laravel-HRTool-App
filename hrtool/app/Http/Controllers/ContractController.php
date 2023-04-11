<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Organization;
use App\Models\Position;
use App\Models\User;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $contracts = Contract::all();
        return view('contracts.index', ['contracts' => $contracts]);
    }

    public function profile($id)
    {

        $employee = User::find($id);
        $contracts = Contract::where('employee_number', $id)->get();
        return view('contracts.profile', ['user_id' => $id], compact('employee', 'contracts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $id)
    {

        $employee = User::find($id);
        $organizations = Organization::all();
        $positions = Position::all();

        return view('contracts.create', compact('organizations', 'positions', 'employee'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([

            'start_date' => 'required|date',
            'position' => 'required|string',
            'organization_id' => 'required|string',
            'type_of_contract' => 'required|string',
            'contract_number' => 'required|string',
            'contract_duration' => 'required|string',
            'net_salary' => 'required|integer',
            'gross_salary_1' => 'required|integer',
            'gross_salary_2' => 'required|integer',
            'location_of_work' => 'required|string',
            'transportation'  => 'required|string',
            'professional_qualifications_level'  => 'required|string',
            'professional_requirements_per_job_systematisation'  => 'required|string',
            'status' => 'required|string',
            'annex_id' => 'nullable|exists:annexes,id',
            'employee_number' => 'required|integer',

        ]);

        $contract = new Contract([
            'start_date' => $request->input('start_date'),
            'position' => $request->input('position'),
            'organization_id' => $request->input('organization_id'),
            'type_of_contract' => $request->input('type_of_contract'),
            'contract_number' => $request->input('contract_number'),
            'contract_duration' => $request->input('contract_duration'),
            'net_salary' => $request->input('net_salary'),
            'gross_salary_1' => $request->input('gross_salary_1'),
            'gross_salary_2' => $request->input('gross_salary_2'),
            'location_of_work' => $request->input('location_of_work'),
            'transportation' => $request->input('transportation'),
            'professional_qualifications_level' => $request->input('professional_qualifications_level'),
            'professional_requirements_per_job_systematisation' => $request->input('professional_requirements_per_job_systematisation'),
            'status' => $request->input('status'),
            'annex_id' => $request->input('annex_id'),
            'employee_number' => $request->input('employee_number'),
        ]);

        $contract->save();

        return redirect('/contracts')->with('success', 'Contract created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //$user = User::findOrFail($id);
        //return view('contract.show', compact('user'));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $contract = Contract::find($id);
        $organizations = Organization::all();
        $positions = Position::all();

        return view('contracts.edit', compact('contract', 'organizations', 'positions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'start_date' => 'required',
            'position' => 'required',
            'organization_id' => 'required',
            'type_of_contract' => 'required',
            'contract_number' => 'required',
            'contract_duration' => 'required',
            'net_salary' => 'required',
            'gross_salary_1' => 'required',
            'gross_salary_2' => 'required',
            'location_of_work' => 'required',
            'transportation'  => 'required',
            'professional_qualifications_level'  => 'required',
            'professional_requirements_per_job_systematisation'  => 'required',
        ]);


        $contract = Contract::find($id);
        $contract->start_date = $request->input('start_date');
        $contract->position = $request->input('position');
        $contract->organization_id = $request->input('organization_id');
        $contract->type_of_contract = $request->input('type_of_contract');
        $contract->contract_number = $request->input('contract_number');
        $contract->contract_duration = $request->input('contract_duration');
        $contract->net_salary = $request->input('net_salary');
        $contract->gross_salary_1 = $request->input('gross_salary_1');
        $contract->gross_salary_2 = $request->input('gross_salary_2');
        $contract->location_of_work = $request->input('location_of_work');
        $contract->transportation = $request->input('transportation');
        $contract->professional_qualifications_level = $request->input('professional_qualifications_level');
        $contract->professional_requirements_per_job_systematisation = $request->input('professional_requirements_per_job_systematisation');

        $contract->save();

        //return redirect('/users/{id}/contracts', ['id' => $contract->employee->id])->with('success', 'Contract updated successfully!');
        return redirect('/contracts')->with('success', 'Contract updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contract::find($id);
        $contract->delete();

        return redirect('/contracts')->with('success', 'Contract deleted successfully!');
    }
}
