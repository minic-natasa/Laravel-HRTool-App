<?php

namespace App\Http\Controllers;

use App\Models\Annex;
use Illuminate\Http\Request;
use App\Models\Contract;
use App\Models\Organization;
use App\Models\Position;
use App\Models\User;

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
            'description' => 'required|string',
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $annex = new Annex([
            'description' => $request->input('description'),
            'contract_id' => $request->input('contract_id'),
        ]);

        $annex->save();

        return redirect('/contracts')->with('success', 'Annex created successfully!');
    }
}
