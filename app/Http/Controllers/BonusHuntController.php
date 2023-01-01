<?php

namespace App\Http\Controllers;

use App\Models\BonusHunt;
use App\Http\Requests\StoreBonusHuntRequest;
use App\Http\Requests\UpdateBonusHuntRequest;
use App\Models\BonusHuntGame;
use Illuminate\Support\Facades\Redirect;

class BonusHuntController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $bonushunt = BonusHunt::all();
        return view('bonushunt.index', compact('bonushunt'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lastid = BonusHunt::latest()->first();
        if ($lastid) {
            $id = $lastid->bonus_name + 1;
        } else {
            $id = 1;
        }
        return view('bonushunt.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBonusHuntRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonusHuntRequest $request)
    {

        $bonushunt = BonusHunt::create($request->all());
        if ($bonushunt) {
            return redirect()->route('bonushunt.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonusHunt  $bonusHunt
     * @return \Illuminate\Http\Response
     */
    public function show(BonusHunt $bonusHunt, $id)
    {
        $bonus = BonusHunt::FindorFail($id);
        return $bonus;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonusHunt  $bonusHunt
     * @return \Illuminate\Http\Response
     */
    public function edit(BonusHunt $bonusHunt, $id)
    {

        $bonus = BonusHunt::FindorFail($id);
        return view('bonushunt.edit', compact('bonus', 'id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBonusHuntRequest  $request
     * @param  \App\Models\BonusHunt  $bonusHunt
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonusHuntRequest $request, BonusHunt $bonusHunt)
    {
        //dd($request->all());
        $games = BonusHuntGame::where('bonus_hunts_id', $request->input('id'))->count();

        if ($games > $request->input('total_game')) {
            session()->flash('errors', 'Game Field already added ' . $games . ' games please add more than!');
            return Redirect::back();
            die;
        }



        $updatedData = array(
            'start_balance' => $request->input('start_balance'),
            'total_game' => $request->input('total_game')
        );
        $update  = BonusHunt::where('id', $request->input('id'))->update($updatedData);

        if ($update) {
            session()->flash('errors', 'Successfully updated!');
            return Redirect::back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonusHunt  $bonusHunt
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonusHunt $bonusHunt, $id)
    {
        $bonus = BonusHunt::FindorFail($id);

        if ($bonus) {
            $bonus->destroy($id);
        }
        return redirect()->route('bonushunt.index');
    }
}
