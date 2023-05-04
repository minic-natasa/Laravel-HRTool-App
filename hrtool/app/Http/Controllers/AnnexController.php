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

        $contract = Contract::find($id);
        return view('annexes.index', ['contracts' => $id], compact('contract'));
    }

    public function create(string $id)
    {

        $contract = Contract::find($id);
        $organizations = Organization::all();
        $positions = Position::all();

        return view('annexes.create', compact('contract', 'positions', 'organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'reason' => 'required|string',
            'old_value' => 'required|string',
            'new_value' => 'required|string',
            'annex_date' => 'required|date',
            'annex_created_date' => 'required|date',
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $request->merge(['deleted' => 0]); // Set deleted to 0
        $annex = new Annex($request->all());
        $annex->save();

        return redirect()->back()->with('success', 'Annex created successfully!');
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
        $employee = $annex->contract->employee;
        $position  = $annex->contract->organization->position->where('id', $annex->contract->position)->first()->name;

        foreach ($employee->contract as $contr) {
            $annexPP = $contr->annexes()->where('reason', 'Promene pozicije')->latest('created_at')->first();

            if ($annexPP) {
                $position = $annexPP->new_value;
            }
        }


        $old_value = $annex->old_value;
        $new_value = $annex->new_value;
        $first_name = $annex->contract->employee->first_name;
        $last_name = $annex->contract->employee->last_name;

        $data = [
            'annex_number' => $annex_number,
            'annex_date' => date('d.m.Y.', strtotime($annex->annex_date)),
            'annex_created_date' => date('d.m.Y.', strtotime($annex->annex_created_date)),
            'first_name' => $first_name,
            'name_of_one_parent' => $annex->contract->employee->name_of_one_parent,
            'last_name' => $last_name,
            'jmbg' => $annex->contract->employee->jmbg,
            'position' => $position,
            'street' => $street,
            'town' => $town,
            'old_value' => $old_value,
            'new_value' => $new_value,

        ];


        if ($annex->reason == 'Promene pozicije') {

            $position = Position::where('name', $annex->new_value)->first();
            $data['position'] = $position;
            $position_description = '';
            foreach (explode("\n", $position->description) as $line) {
                $position_description .= "·&nbsp;" . trim($line) . "<br>";
            }
            $data['position_description'] = $position_description;
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.annex1', $data);
            return $pdf->stream('aneks-promena-pozicije.pdf');
        } elseif ($annex->reason == 'Povećanja bruto 1 zarade') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.annex2', $data);
            return $pdf->stream('aneks-povećanje-bruto1-zarade.pdf');
        } elseif ($annex->reason == 'Promene adrese obavljanja posla') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.annex3', $data);
            return $pdf->stream('aneks-promena-adrese-obavljanja-posla.pdf');
        } elseif ($annex->reason == 'Promene adrese poslodavca') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.annex4', $data);
            return $pdf->stream('aneks-promena-adrese-poslodavca.pdf');
        } elseif ($annex->reason == 'Promene radnih sati') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.annex5', $data);
            return $pdf->stream('aneks-promena-radnih-sati.pdf');
        }
    }

    public function notice_pdf(string $id)
    {
        $annex = Annex::find($id); // retrieve the contract data from the database
        $address_parts = explode(',', $annex->contract->employee->address_in_ID);
        $street = trim($address_parts[0]);
        $town = trim($address_parts[1]);

        $town = $this->changeTownDisplay($town);
        $annex_date = new DateTime($annex->annex_date);

        $net_salary = number_format($annex->net_salary, 2, ',', '.');
        $gross_salary_1 = number_format($annex->gross_salary_1, 2, ',', '.');
        $gross_salary_2 = number_format($annex->gross_salary_2, 2, ',', '.');


        $data = [
            'annex_date' => date('d.m.Y.', strtotime($annex->annex_date)),
            'position'  => $annex->contract->organization->position->where('id', $annex->contract->position)->first()->name,
            'employee_number'  => $annex->employee_number,
            'type_of_contract'  => $annex->type_of_contract,
            'contract_number'  => $annex->contract_number,
            'annex_created_date' => date('d.m.Y.', strtotime($annex->annex_created_date)),
            'net_salary'  => $net_salary,
            'gross_salary_1' => $gross_salary_1,
            'gross_salary_2'  => $gross_salary_2,
            'first_name' => $annex->contract->employee->first_name,
            'name_of_one_parent' => $annex->contract->employee->name_of_one_parent,
            'last_name' => $annex->contract->employee->last_name,
            'jmbg' => $annex->contract->employee->jmbg,
            'current_address' => $annex->contract->employee->current_address,
            'street' => $street,
            'town' => $town,
        ];


        if ($annex->reason == 'Promene pozicije') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.notice1', $data);
            return $pdf->stream('obaveštenje-promena-pozicije.pdf');
        } elseif ($annex->reason == 'Povećanja bruto 1 zarade') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.notice2', $data);
            return $pdf->stream('obaveštenje-povećanje-bruto1-zarade.pdf');
        } elseif ($annex->reason == 'Promene adrese obavljanja posla') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.notice3', $data);
            return $pdf->stream('obaveštenje-promena-adrese-obavljanja-posla.pdf');
        } elseif ($annex->reason == 'Promene adrese poslodavca') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.notice4', $data);
            return $pdf->stream('obaveštenje-promena-adrese-poslodavca.pdf');
        } elseif ($annex->reason == 'Promene radnih sati') {
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('contracts.pdf.annex.notice5', $data);
            return $pdf->stream('obaveštenje-promena-radnih-sati.pdf');
        }
    }
}
