<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Organization;
use App\Models\Position;
use App\Models\User;
use Barryvdh\DomPDF\PDF;
use DateTime;
use DateInterval;


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
            'first_day_on_job' => 'required|date',
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
            'status' => 'required|string',
            'annex_id' => 'nullable|exists:annexes,id',
            'employee_number' => 'required|integer',
        ]);

        $probationary_period = ($request->input('contract_duration') === 'unlimited' && $request->input('probationary_period') !== null) ? $request->input('probationary_period') : 0;

        $contract = new Contract([
            'start_date' => $request->input('start_date'),
            'first_day_on_job' => $request->input('first_day_on_job'),
            'position' => $request->input('position'),
            'organization_id' => $request->input('organization_id'),
            'type_of_contract' => $request->input('type_of_contract'),
            'contract_number' => $request->input('contract_number'),
            'contract_duration' => $request->input('contract_duration'),
            'probationary_period' => $probationary_period,
            'net_salary' => $request->input('net_salary'),
            'gross_salary_1' => $request->input('gross_salary_1'),
            'gross_salary_2' => $request->input('gross_salary_2'),
            'location_of_work' => $request->input('location_of_work'),
            'transportation' => $request->input('transportation'),
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
            'first_day_on_job' => 'required',
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
        ]);

        $probationary_period = ($request->input('contract_duration') === 'unlimited' && $request->input('probationary_period') !== null) ? $request->input('probationary_period') : 0;

        $contract = Contract::find($id);
        $contract->start_date = $request->input('start_date');
        $contract->first_day_on_job = $request->input('first_day_on_job');
        $contract->position = $request->input('position');
        $contract->organization_id = $request->input('organization_id');
        $contract->type_of_contract = $request->input('type_of_contract');
        $contract->contract_number = $request->input('contract_number');
        $contract->contract_duration = $request->input('contract_duration');
        $contract->probationary_period = $probationary_period; // Update the probationary period field
        $contract->net_salary = $request->input('net_salary');
        $contract->gross_salary_1 = $request->input('gross_salary_1');
        $contract->gross_salary_2 = $request->input('gross_salary_2');
        $contract->location_of_work = $request->input('location_of_work');
        $contract->transportation = $request->input('transportation');

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

    public function pdf(string $id) //contractID
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);

        $start_date = new DateTime($contract->start_date);

        $position_description = '';
        foreach (explode("\n", $contract->organization->position->where('id', $contract->position)->first()->description) as $line) {
            $position_description .= "·&nbsp;" . trim($line) . "<br>";
        }
        $data['position_description'] = $position_description;
        $data = [
            'start_date' => date('d.m.Y', strtotime($contract->start_date)),
            'first_day_on_job' => date('d.m.Y.', strtotime($contract->first_day_on_job)),
            'position'  => $contract->organization->position->where('id', $contract->position)->first()->name,
            'position_description' => $position_description,
            'employee_number'  => $contract->employee_number,
            'type_of_contract'  => $contract->type_of_contract,
            'contract_number'  => $contract->contract_number,
            'contract_duration'  => $contract->contract_duration,
            'probationary_period'  => $contract->probationary_period,
            'probationary_period_text' => '',
            'net_salary'  => $contract->net_salary,
            'gross_salary_1' => number_format($contract->gross_salary_1, 2, ',', '.'),
            'gross_salary_2'  => $contract->gross_salary_2,
            'location_of_work'  => $contract->location_of_work,
            'transportation'  => $contract->transportation,
            'first_name' => $contract->employee->first_name,
            'name_of_one_parent' => $contract->employee->name_of_one_parent,
            'last_name' => $contract->employee->last_name,
            'jmbg' => $contract->employee->jmbg,
            'current_address' => $contract->employee->current_address,
            'street' => $street,
            'town' => $town,
            'professional_qualifications_level' => $contract->employee->professional_qualifications_level,
            'profession'  => $contract->employee->profession,
        ];

        switch ($contract->probationary_period) {
            case 0:
                $data['probationary_period_text'] = 'nula';
                break;
            case 1:
                $data['probationary_period_text'] = 'jedan';
                break;
            case 2:
                $data['probationary_period_text'] = 'dva';
                break;
            case 3:
                $data['probationary_period_text'] = 'tri';
                break;
            case 4:
                $data['probationary_period_text'] = 'četiri';
                break;
            case 5:
                $data['probationary_period_text'] = 'pet';
                break;
            case 6:
                $data['probationary_period_text'] = 'šest';
                break;
            default:
                $data['probationary_period_text'] = '';
                break;
        }

        if ($contract->contract_duration != 'unlimited' && $contract->location_of_work == 'Hybrid') {
            $contract_duration = new DateInterval('P' . $contract->contract_duration . 'M');
            $end_date = $start_date->add($contract_duration)->format('d.m.Y');
            $data['end_date'] = $end_date;
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.o-h', $data);
            return $pdf->stream('contract.pdf');
        } elseif ($contract->contract_duration != 'unlimited' && $contract->location_of_work == 'Remote') {
            $contract_duration = new DateInterval('P' . $contract->contract_duration . 'M');
            $end_date = $start_date->add($contract_duration)->format('d.m.Y');
            $data['end_date'] = $end_date;
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.o-r', $data);
            return $pdf->stream('contract.pdf');
        } elseif ($contract->location_of_work == 'Hybrid') {
            $data['contract_duration'] = 'unlimited';
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.no-h', $data);
            return $pdf->stream('contract.pdf');
        } elseif ($contract->location_of_work == 'Remote') {
            $data['contract_duration'] = 'unlimited';
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.no-r', $data);
            return $pdf->stream('contract.pdf');
        }
    }
}
