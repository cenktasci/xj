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
        static::updating(function ($game) {
            $game->bonus_name_slug = Str::slug($game->bonus_name);
        });
    }
}
