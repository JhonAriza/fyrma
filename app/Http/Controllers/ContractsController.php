<?php

namespace App\Http\Controllers;

use App\Models\Contracts;
use App\Models\Logs;
use App\Models\Trackings;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ContractsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $contract_id)
    {
        $contract = Contracts::find($contract_id);
        $ip = $request->ip();
        if ($contract->status === "progress") {
            $contract->status = "read";
            $contract->save();

            $track = new Trackings;
            $track->contract_id = $contract->id;
            $track->owner = Auth::user()->email;
            $track->type = 'ha entrado a leer';
            $track->value = 'el contrato';
            $track->save();

            $track = new Logs;
            $track->contract_id = $contract->id;
            $track->type = 'read contract';
            $track->value = json_encode(['IP' => $ip, 'DATE' => Carbon::now()]);
            $track->save();
        }
        return view('received.show', compact('contract_id', 'ip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pendingSignature(Request $request) {
        if (!$request->hasValidSignature()) {
            abort(403);
        } else if(Auth::user()->email != Crypt::decryptString($request->use)){
            session()->flash('denied', 'Acceso no Permitido.');
            return redirect()->to('/dashboard');
        } else {
            $contract_id = Crypt::decryptString($request->con);
            $user = Crypt::decryptString($request->use);
            $data = $request->all();
            $contract = Contracts::find($contract_id);
            $id_participant = $this->searchmyparticipant(json_decode($contract->participants));
            $ip = $request->ip();
            $participants = json_decode($contract->participants);
            if ($participants[$id_participant]->status == "Pendiente") {
                $participants[$id_participant]->status = "Leido";
                $contract->participants = json_encode($participants);
                $contract->save();

                $track = new Trackings;
                $track->contract_id = $contract->id;
                $track->owner = $user;
                $track->type = 'ha entrado a leer';
                $track->value = 'el contrato';
                $track->save();

                $track = new Logs;
                $track->contract_id = $contract->id;
                $track->type = 'read contract';
                $track->value = json_encode(['IP' => $ip, 'DATE' => Carbon::now()]);
                $track->save();
            }
            return view('contracts.edit', compact('contract_id','user','ip','id_participant'));
        }
    }

    private function searchmyparticipant($participants) {
        $part = Arr::where($participants, function ($value) {
            return $value->correo == Auth::user()->email;
        });
        return array_keys($part)[0];
    }
}
