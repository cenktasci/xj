<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;
    protected $guarded = [];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($provider) {
            $provider->provider_name_slug = Str::slug($provider->provider_name);
        });
        static::updating(function ($provider) {
            $provider->provider_name_slug = Str::slug($provider->provider_name);
        });
    }

    public function game()
    {
        return $this->hasMany(Game::class);
    }
}
