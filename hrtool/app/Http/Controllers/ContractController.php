<?php

namespace App\Http\Controllers;

use App\Models\Annex;
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
        $annexes = Annex::all();
        $organizations = Organization::all();
        $positions = Position::all();
        $contracts = Contract::all();
        return view('contracts.index', ['contracts' => $contracts], compact('annexes', 'organizations', 'positions'));
    }

    public function profile($id)
    {

        $employee = User::find($id);
        $organizations = Organization::all();
        $positions = Position::all();
        $contracts = Contract::where('employee_number', $id)->get();
        return view('contracts.profile', ['user_id' => $id], compact('employee', 'contracts', 'organizations', 'positions'));
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
            'net_salary' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'gross_salary_1' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'gross_salary_2' => ['required', 'numeric', 'regex:/^\d+(\.\d{1,2})?$/'],
            'location_of_work' => 'required|string',
            'transportation'  => 'required|string',
            'status' => 'required|string',
            'employee_number' => 'required|integer',
        ]);

        // Replace commas with dots in the net_salary and gross_salary fields
        $request->merge([
            'net_salary' => str_replace(',', '.', $request->input('net_salary')),
            'gross_salary_1' => str_replace(',', '.', $request->input('gross_salary_1')),
            'gross_salary_2' => str_replace(',', '.', $request->input('gross_salary_2')),
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $contract = Contract::find($id);
        $activeAnnexes = $contract->annexes->where('deleted', false);

        // Check if there are related annexes
        if ($activeAnnexes->isNotEmpty()) {
            // If there are deleted annexes, delete the contract
            return redirect()->route('contracts.index')->with('error', 'You cannot delete a contract with annexes.');
        } else {
            $contract->status = 'inactive';
            $contract->save();
            return redirect()->route('contracts.index')->with('success', 'Contract deleted successfully');
        }
    }

    public function changeTownDisplay($t)
    {
        $changed = '';

        //Non-ordinary
        if ($t == "Novi Sad") {
            $changed = "Novog Sada";
            return $changed;
        }

        if ($t == "Novi Pazar") {
            $changed = "Novog Pazara";
            return $changed;
        }

        if ($t == "Sremska Mitrovica") {
            $changed = "Sremske Mitrovice";
            return $changed;
        }

        if ($t == "Čačak") {
            $changed = "Čačka";
            return $changed;
        }

        if ($t == "Šabac") {
            $changed = "Šapca";
            return $changed;
        }

        $lastLetter = $t[strlen($t) - 1];
        if ($lastLetter === "a") {
            $changed = substr($t, 0, -1) . "e";
        } else if ($lastLetter === "e") {
            $changed = substr($t, 0, -1) . "a";
        } else if ($lastLetter === "i") {
            $changed = substr($t, 0, -1) . "a";
        } else if ($lastLetter === "o") {
            $changed = substr($t, 0, -1) . "a";
        } else if ($lastLetter === "c") {
            $changed = substr($t, 0, -2) . "ca";
        } else {
            $changed = $t . "a";
        }
        return $changed;
    }

    public function pdf(string $id) //contractID
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);


        $town = $this->changeTownDisplay($town);
        $start_date = new DateTime($contract->start_date);

        $net_salary = number_format($contract->net_salary, 2, ',', '.');
        $gross_salary_1 = number_format($contract->gross_salary_1, 2, ',', '.');
        $gross_salary_2 = number_format($contract->gross_salary_2, 2, ',', '.');

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
            'net_salary'  => $net_salary,
            'gross_salary_1' => $gross_salary_1,
            'gross_salary_2'  => $gross_salary_2,
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


    public function mob(string $id)
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);

        $data = [
            'first_name' => $contract->employee->first_name,
            'name_of_one_parent' => $contract->employee->name_of_one_parent,
            'last_name' => $contract->employee->last_name,
            'address_in_id' => $contract->employee->address_in_ID,
            'street' => $street,
            'town' => $town,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.mob', $data);
        return $pdf->stream('obaveštenje-o-mobingu.pdf');
    }

    public function uzb(string $id)
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);

        $data = [
            'first_name' => $contract->employee->first_name,
            'name_of_one_parent' => $contract->employee->name_of_one_parent,
            'last_name' => $contract->employee->last_name,
            'address_in_id' => $contract->employee->address_in_ID,
            'street' => $street,
            'town' => $town,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.uzb', $data);
        return $pdf->stream('obaveštenje-o-zakonu-o-uzbunjivačima.pdf');
    }

    public function odm(string $id)
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);
        $current_year = date('Y');

        $town = $this->changeTownDisplay($town);

        $data = [
            'first_name' => $contract->employee->first_name,
            'name_of_one_parent' => $contract->employee->name_of_one_parent,
            'last_name' => $contract->employee->last_name,
            'address_in_id' => $contract->employee->address_in_ID,
            'street' => $street,
            'town' => $town,
            'current_year' => $current_year,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.odm', $data);
        return $pdf->stream('zahtev-za-korišćenje-godišnjeg-odmora.pdf');
    }

    public function nda(string $id)
    {
        $contract = Contract::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);
        $current_year = date('Y');
        $start_date = new DateTime($contract->start_date);

        $town = $this->changeTownDisplay($town);

        $data = [
            'first_name' => $contract->employee->first_name,
            'name_of_one_parent' => $contract->employee->name_of_one_parent,
            'last_name' => $contract->employee->last_name,
            'address_in_id' => $contract->employee->address_in_ID,
            'jmbg' => $contract->employee->jmbg,
            'start_date' => date('d.m.Y.', strtotime($contract->start_date)),
            'street' => $street,
            'town' => $town,
            'current_year' => $current_year,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.nda', $data);
        return $pdf->stream('sporazum-o-poverljivosti.pdf');
    }
}
