<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($game) {
            $game->slot_name_slug = Str::slug($game->slot_name);
        });
        static::updating(function ($game) {
            $game->slot_name_slug = Str::slug($game->slot_name);
        });
    }
}
