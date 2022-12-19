<?php

namespace App\Http\Controllers;

use App\Models\Provider;
use App\Http\Requests\StoreProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Models\Game;

class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$provider =  file_get_contents('provider.json');
        $provider = json_decode($provider);
        $provider = $provider->response;*/

        $provider = Provider::all();
        return view('provider.index', compact('provider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('provider.create');
    }

    public function create2()
    {
        $provider =  file_get_contents('provider.json');
        $provider = json_decode($provider);
        $provider = $provider->response;
        $provider =  json_encode($provider);
        $provider =  json_decode($provider, true);

        for ($i = 0; $i < count($provider); $i++) {
            $name = $provider[$i]["provider_name"];
            $slug = $provider[$i]["provider_slug"];
            $logo = $provider[$i]["provider_logo"];
            $cover = $provider[$i]["provider_cover"];
            $check =  Provider::where('provider_name', $name)->count() > 0;
            if (!$check) {
                $saveData = [
                    'provider_name' => $name,
                    'provider_name_slug' => $slug,
                    'provider_logo' => $logo,
                    'provider_picture' => $cover,
                    'provider_explanation' => $name,
                ];
                $add = Provider::create($saveData);
            }
        }
        echo "1";
    }


    public function create3()
    {
        $game =  file_get_contents('games.json');
        $game = json_decode($game);
        $game = $game->response;
        $game =  json_encode($game);
        $game =  json_decode($game, true);



        for ($i = 0; $i < count($game); $i++) {

            $name = $game[$i]["slot_name"];
            $slug = $game[$i]["slot_slug"];
            $slot_picture = $game[$i]["slot_image"];
            $slot_provider_slug = $game[$i]["slot_provider_slug"];
            $provider_id =  Provider::where('provider_name_slug', $slot_provider_slug)->first();

            $slot_volatility = $game[$i]["slot_rating"];
            $slot_rtp = "";
            $check =  Game::where('slot_name', $name)->count() > 0;
            if (!$check) {
                $saveData = [
                    'provider_id' => $provider_id->id,
                    'slot_name' => $name,
                    'slot_name_slug' => $slug,
                    'slot_picture' => $slot_picture,
                    'slot_rtp' => $slot_rtp,
                    'slot_volatility' => $slot_volatility,
                ];
                $add = Game::create($saveData);
            }
        }
        echo "1";
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProviderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProviderRequest $request)
    {
        $create =  Provider::create($request->all());
        if ($create) {
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function show(Provider $provider)
    {
        return Provider::FindorFail($provider->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function edit(Provider $provider)
    {
        $provider = Provider::FindorFail($provider->id);
        return view('provider.edit', compact('provider'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProviderRequest  $request
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProviderRequest $request, Provider $provider)
    {
        $provider = Provider::find($provider->id);
        if ($provider === null) {
            return "";
        }
        $provider->update($request->all());
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Provider  $provider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Provider $provider)
    {
        $provider = Provider::FindorFail($provider->id);
        if ($provider) {
            $provider->destroy($provider->id);
        }
        return redirect()->route('provider.index');
    }
}
