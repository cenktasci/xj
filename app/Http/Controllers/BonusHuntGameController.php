<?php

namespace App\Http\Controllers;

use App\Models\BonusHuntGame;
use App\Http\Requests\StoreBonusHuntGameRequest;
use App\Http\Requests\UpdateBonusHuntGameRequest;
use App\Models\BonusHunt;
use App\Models\Game;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Redirect;

class BonusHuntGameController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        $bonushunt =  BonusHunt::FindorFail($id);
        $bonushuntGames = BonusHuntGame::where('bonus_hunts_id', $id)->count();
        $games =  Game::all();


        return view('bonushuntgame.create', compact('bonushunt', 'games', 'bonushuntGames'));
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
            BonusHuntGame::create($dataSave);
        }


        $check = BonusHuntGame::where('bonus_hunts_id', $bonushunt_id)->count();
        $addGames =  count($game);
        $update = BonusHunt::where('id', $bonushunt_id)->first();

        if ($check != $update->total_game) {
            $totalGames = $update->total_game;
            $totalGamesNew = $totalGames + $addGames;
            BonusHunt::where('id', $bonushunt_id)->update(['total_game' => $totalGamesNew]);
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

        $games1 = BonusHunt::find($id)->first();
        $games = BonusHuntGame::where('bonus_hunts_id', $id)->count();


        if ($games == 0) {
            session()->flash('errors', 'You have got ' . $games1->total_game . ' games! but You have got edit page only ' . $games . ' games please click first new game and add!');
            return Redirect::back();
            die;
        }


        $total = BonusHunt::getTotal($id);
        $multi = BonusHunt::getMultiplier($id);

        $bonushunt =  BonusHunt::FindorFail($id);
        $games1 =  BonusHuntGame::where('bonus_hunts_id', $id)->get();
        $games =  Game::all();


        $totalGame = $games1->count();
        if ($totalGame == 0) {
            session()->flash('errors', 'No Game added yet!');
            return Redirect::back();
        }


        $bonushuntgame =  BonusHuntGame::where("bonus_hunts_id", $bonushunt->id)->get();



        return view('bonushuntgame.edit', compact('bonushunt', 'games', 'games1', 'bonushuntgame', 'total', 'multi'));
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

        $bonushunt_id = $request->input('bonus_hunts_id');
        $game_id = $request->input('game_id');
        $result = $request->input('result');
        $bet = $request->input('bet');
        $multiplier =  round($result / $bet);
        $update =  BonusHuntGame::where('bonus_hunts_id', $bonushunt_id)->where('id', $game_id)->update(['result' => $result, 'bet' => $bet, 'multiplier' => $multiplier]);
        $multix = BonusHunt::getMultiplier($bonushunt_id);

        $totalresult =  BonusHuntGame::where('bonus_hunts_id', $bonushunt_id)->sum('result');

        if ($update) {
            $a = array(
                'multiplier' => $multix,
                'totalresult' => $totalresult,
                'response' => 1,
            );

            $id = $request->input("bonus_hunts_id");

            $total = BonusHunt::getTotal($id);
            //todo  multi duzelt.
            $balance  = BonusHunt::where('id', $id)->update(['finish_balance' => $total]);



            $multix = BonusHunt::getMultiplier($id);
            $totalGameCount = BonusHunt::getTotalGameCount($id);
            $multi = round($multix / $totalGameCount);
            if ($balance) {
                BonusHunt::where('id', $id)->update(['games_avg' => $multi]);
                return json_encode($a);
            }
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
