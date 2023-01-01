<?php

namespace App\Models;

use Illuminate\Support\Str;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BonusHunt extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provider()
    {
        return $this->hasMany(Provider::class);
    }

    static public function  getTotal($id)
    {
        return BonusHuntGame::where('bonus_hunts_id', $id)->sum('result');
    }

    static public function  getMultiplier($id)
    {
        return BonusHuntGame::where('bonus_hunts_id', $id)->sum('multiplier');
    }
    static public function  getTotalGameCount($id)
    {
        return BonusHuntGame::where('bonus_hunts_id', $id)->whereNotNull('result')->count();
    }

    public function game()
    {
        return $this->hasMany(Game::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($game) {
            $game->bonus_name_slug = Str::slug($game->bonus_name);
        });
    }
}
