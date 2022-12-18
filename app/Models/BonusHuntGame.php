<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class BonusHuntGame extends Model
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

    public function bonushunt()
    {
        return $this->belongsTo(BonusHunt::class);
    }
}
