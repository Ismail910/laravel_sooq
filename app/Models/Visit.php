<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visit extends Model
{
    use HasFactory;

    protected $fillable = [
        'device_id',
    ];

    public static function addVisitIfNotExists($device_id)
    {
        if (!self::where('ip', $device_id)->exists()) {
            self::create([
                'device_id' => $device_id,
            ]);
        }
    }
}