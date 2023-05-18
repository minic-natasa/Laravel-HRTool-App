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

class AnnexController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
    }

    public function create(string $id)
    {

        $contract = Contract::find($id);
        $organizations = Organization::all();
        $positions = Position::all();

        return view('contracts.annex', compact('contract', 'positions', 'organizations'));
    }

    public function store(Request $request)
    {


        $request->validate([
            'reason' => 'required|array|min:1',
            'old_gross_salary' => 'nullable|string',
            'gross_salary' => 'nullable|string',
            'old_position' => 'nullable|string',
            'position' => 'nullable|string',
            'old_address_of_work' => 'nullable|string',
            'address_of_work' => 'nullable|string',
            'old_address_of_employer' => 'nullable|string',
            'address_of_employer' => 'nullable|string',
            'old_working_hours' => 'nullable|string',
            'working_hours' => 'nullable|string',
            'annex_date' => 'required|date',
            'annex_created_date' => 'required|date',
            'deleted' => 'required|boolean',
            'contract_id' => 'required|integer',
        ]);

        $reasons = implode(',', $request->input('reason'));
        $annex = new Annex([

            'old_gross_salary' => $request->input('old_gross_salary'),
            'gross_salary' => $request->input('gross_salary'),

            'old_position' => $request->input('old_position'),
            'position' => $request->input('position'),

            'old_address_of_work' => $request->input('old_address_of_work'),

            'old_address_of_employer' => $request->input('old_address_of_employer'),
            'address_of_employer' => $request->input('address_of_employer'),

            'old_working_hours' => $request->input('old_working_hours'),
            'working_hours' => $request->input('working_hours'),

            'annex_date' => $request->input('annex_date'),
            'annex_created_date' => $request->input('annex_created_date'),

            'contract_id' => $request->input('contract_id'),
            'deleted' => $request->input('deleted'),

            'reason' => $reasons,
        ]);

        $annex->address_of_work = $request->address_of_work;
        $annex->save();
        $contract = Contract::find($request->input('contract_id'));
        return redirect()->route('contracts.profile', ['id' => $contract->employee])->with('success', 'Annex created successfully!');
    }

    public function getAnnexesByContract($contract_id)
    {
        $contract = Contract::with('annexes')->findOrFail($contract_id);

        // Filter the annexes to remove the deleted ones
        $annexes = $contract->annexes->filter(function ($annex) {
            return $annex->deleted === 0;
        });

        return response()->json($annexes);
    }

    public function destroy(string $id)
    {
        $annex = Annex::find($id);
        $annex->deleted = true;
        $annex->save();
        return redirect()->back()->with('success', 'Annex deleted successfully!');
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

    public function annex_pdf(string $id, int $annex_number)
    {
        $annex = Annex::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $annex->contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);
        $town = $this->changeTownDisplay($town);

        $first_name = $annex->contract->employee->first_name;
        $last_name = $annex->contract->employee->last_name;
        $name_of_one_parent = $annex->contract->employee->name_of_one_parent;
        $current_address = $annex->contract->employee->current_address;

        $reason = $annex->reason;
        $reasons = explode(',', $reason);
        $reasons = array_map('trim', $reasons);

        $employee = $annex->contract->employee;
        $position = $annex->contract->organization->position->where('id', $annex->contract->position)->first()->name;
        $employer = 'Makedonska 12, Beograd';

        $annexPosition = $annex->position;
        $annexGrossSalary =  number_format($annex->gross_salary, 2, ',', '.');
        $annexWorkingAddress = $annex->address_of_work;
        $annexEmployerAddress = $annex->address_of_employer;
        $annexWorkingHours = $annex->working_hours;

        $position_description = '';
        $pos = null;

        if ($annexPosition) {
            $pos = Position::where('name', $annex->position)->first();
            foreach (explode("\n", $pos->description) as $line) {
                $position_description .= "·&nbsp;" . trim($line) . "<br>";
            }
        }


        foreach ($employee->contract as $contr) {
            $reasonToSearch1 = 'Promena pozicije';
            $latestAnnexPos = $contr->annexes()
                ->where('deleted', 0)
                ->where('annex_date', '<', $annex->annex_date) // Add this condition to filter annexes created before the current $annex
                ->whereRaw("FIND_IN_SET('$reasonToSearch1', reason) > 0")
                ->orderByDesc('annex_date')
                ->first();

            if ($latestAnnexPos) {
                if (in_array('Promena pozicije', $reasons)) {
                    $position = $latestAnnexPos->old_position;
                }
                $position = $latestAnnexPos->position;
            }

            $reasonToSearch2 = 'Promena adrese poslodavca';
            $latestAnnexEmp = $contr->annexes()
                ->where('deleted', 0)
                ->where('annex_date', '<', $annex->annex_date) // Add this condition to filter annexes created before the current $annex
                ->whereRaw("FIND_IN_SET('$reasonToSearch2', reason) > 0")
                ->orderByDesc('annex_date')
                ->first();

            if ($latestAnnexEmp) {
                if (in_array('Promena adrese poslodavca', $reasons)) {
                    $employer = $latestAnnexEmp->old_address_of_employer;
                }
                $employer = $latestAnnexEmp->address_of_employer;
            }
        }

        $employer_parts = explode(',', $employer);
        $employerStreet = trim($employer_parts[0]);
        $employerTown = trim($employer_parts[1]);

        $data = [
            'annex_number' => $annex_number,
            'first_name' => $first_name,
            'name_of_one_parent' => $name_of_one_parent,
            'last_name' => $last_name,
            'jmbg' => $annex->contract->employee->jmbg,
            'street' => $street,
            'town' => $town,
            'position' => $position,
            'annex_date' => date('d.m.Y.', strtotime($annex->annex_date)),
            'annex_created_date' => date('d.m.Y.', strtotime($annex->annex_created_date)),
            'annexPosition' => $annexPosition,
            'annexGrossSalary' => $annexGrossSalary,
            'annexWorkingAddress' => $annexWorkingAddress,
            'annexEmployerAddress' => $annexEmployerAddress,
            'annexWorkingHours' => $annexWorkingHours,
            'current_address' => $current_address,
            'employer' => $employer,
            'position_description' => $position_description,
            'pos' => $pos,
            'employerStreet' => $employerStreet,
            'employerTown' => $employerTown,
        ];

        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.annex.annex', $data);
        return $pdf->stream('aneks-ugovora-o-radu.pdf');
    }


    public function notice_pdf(string $id)
    {
        $annex = Annex::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $annex->contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);
        $town = $this->changeTownDisplay($town);

        $first_name = $annex->contract->employee->first_name;
        $last_name = $annex->contract->employee->last_name;
        $name_of_one_parent = $annex->contract->employee->name_of_one_parent;


        $reason = $annex->reason;
        $reasons = explode(',', $reason);
        $reasons = array_map('trim', $reasons);

        $annexReason = '';

        $employee = $annex->contract->employee;
        $position  = $annex->contract->organization->position->where('id', $annex->contract->position)->first()->name;

        foreach ($employee->contract as $contr) {

            $reasonToSearch = 'Promena pozicije';
            $latestAnnexPos = $contr->annexes()
                ->where('deleted', 0)
                ->where('annex_date', '<', $annex->annex_date) // Add this condition to filter annexes created before the current $annex
                ->whereRaw("FIND_IN_SET('$reasonToSearch', reason) > 0")
                ->orderByDesc('annex_date')
                ->first();

            if ($latestAnnexPos) {

                if (in_array('Promena pozicije', $reasons)) {
                    $position = $latestAnnexPos->old_position;
                }

                $position = $latestAnnexPos->position;
            }
        }

        if (in_array('Povećanje bruto 1 zarade', $reasons)) {
            $annexReason .= 'u pogledu povećanja bruto 1 zarade';
        }

        if (in_array('Promena pozicije', $reasons)) {
            if ($annexReason !== '') {
                $annexReason .= ', ';
            }
            $annexReason .= 'u promeni radne pozicije';
        }

        if (in_array('Promena adrese poslodavca', $reasons)) {
            if ($annexReason !== '') {
                $annexReason .= ', ';
            }
            $annexReason .= 'u promeni adrese poslodavca';
        }

        if (in_array('Promena radnih sati', $reasons)) {
            if ($annexReason !== '') {
                $annexReason .= ', ';
            }
            $annexReason .= 'u promeni radnih sati';
        }

        if (in_array('Promena adrese obavljanja posla', $reasons)) {
            if ($annexReason !== '') {
                $annexReason .= ', ';
            }
            $annexReason .= 'u promeni adrese obavljanja posla';
        }

        if (count($reasons) > 1) {
            $lastCommaIndex = strrpos($annexReason, ',');
            $annexReason = substr_replace($annexReason, ' i', $lastCommaIndex, 1);
        }

        $data = [

            'first_name' => $first_name,
            'name_of_one_parent' => $name_of_one_parent,
            'last_name' => $last_name,
            'jmbg' => $annex->contract->employee->jmbg,
            'street' => $street,
            'town' => $town,

            'position'  => $position,
            'annex_created_date' => date('d.m.Y.', strtotime($annex->annex_created_date)),
            'annex_reason' => $annexReason,
        ];


        $pdf = app('dompdf.wrapper');
        $pdf->loadView('contracts.pdf.annex.notice', $data);
        return $pdf->stream('obaveštenje-o-ponudi-za-zaključenje-aneksa-ugovora-o-radu.pdf');
    }
}
