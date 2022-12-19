<?php

namespace App\Http\Controllers;

use App\Models\BonusHuntGame;
use App\Http\Requests\StoreBonusHuntGameRequest;
use App\Http\Requests\UpdateBonusHuntGameRequest;
use App\Models\BonusHunt;
use App\Models\Game;

class BonusHuntGameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        echo "x";
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $bonushunt =  BonusHunt::FindorFail($id);
        $games =  Game::all();
        return view('bonushunt game.create', compact('bonushunt', 'games'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreBonusHuntGameRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBonusHuntGameRequest $request)
    {

        $bonushunt_id = $request->input('bonushunt_id');
        $game = $request->input('game');
        $bet = $request->input('bet');

        for ($i = 0; $i < count($game); $i++) {
            $dataSave =  [
                'bonus_hunts_id' => $bonushunt_id,
                'game_id' => $game[$i],
                'bet' => $bet[$i]
            ];

            $data =  BonusHuntGame::create($dataSave);
            if ($data) {
                echo "1";
            }
            /*
            $table->unsignedBigInteger('game_id');
            $table->string('bet');
            $table->string('multiplier')->nullable();
            $table->string('result')->nullable();
             */
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BonusHuntGame  $bonusHuntGame
     * @return \Illuminate\Http\Response
     */
    public function show(BonusHuntGame $bonusHuntGame)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BonusHuntGame  $bonusHuntGame
     * @return \Illuminate\Http\Response
     */
    public function edit(BonusHuntGame $bonusHuntGame, $id)
    {
        $bonushunt =  BonusHunt::FindorFail($id);
        $games =  Game::all();
        $bonushuntgame =  BonusHuntGame::where("bonus_hunts_id", $bonushunt->id)->get();


        return view('bonushunt game.edit', compact('bonushunt', 'games', 'bonushuntgame'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBonusHuntGameRequest  $request
     * @param  \App\Models\BonusHuntGame  $bonusHuntGame
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBonusHuntGameRequest $request, BonusHuntGame $bonusHuntGame)
    {
        //print_r($request->all());
        $bonushunt_id = $request->input('bonus_hunts_id');
        $game_id = $request->input('game_id');
        $result = $request->input('result');
        $bet = $request->input('bet');

        $update =  BonusHuntGame::where('bonus_hunts_id',$bonushunt_id)->where('id',$game_id)->update(['result' => $result,'bet' => $bet]);

        if($update){
            return "1";
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BonusHuntGame  $bonusHuntGame
     * @return \Illuminate\Http\Response
     */
    public function destroy(BonusHuntGame $bonusHuntGame)
    {
        //
    }
}
