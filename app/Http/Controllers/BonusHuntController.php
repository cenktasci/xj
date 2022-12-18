<?php

namespace App\Http\Controllers;

use App\Models\BonusHunt;
use App\Http\Requests\StoreBonusHuntRequest;
use App\Http\Requests\UpdateBonusHuntRequest;

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
        return view('bonushunt.create');
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
        return view('bonushunt.edit', compact('bonus'));
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
        //
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
