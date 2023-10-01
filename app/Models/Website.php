<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Website extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'url', 'tracking_script_key', 'description',
    ];
    public $timestamps = true;

    // Generate tracking script key automatically
    protected static function boot(): void
    {
        parent::boot();

        static::creating(function ($website) {
            // Generate a random tracking script key (16 characters, alphanumeric)
            $trackingScriptKey = Str::random(16);
            $website->tracking_script_key = $trackingScriptKey;
        });
    }
}
