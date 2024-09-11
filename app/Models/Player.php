<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Player extends Model
{
    use HasFactory;

    protected $primaryKey = 'uuid';
    public $incrementing = false; // Desactivar el auto-incremento porque 'uuid' no es auto-incremental
    protected $keyType = 'string'; // El tipo de clave primaria es string

    static $rules = [
        'sistemas' => 'required|boolean',
        'line' => 'required|string',
        'otp' => 'required|string',
        'ip' => 'nullable|string|unique:players,ip',
        'token' => 'nullable|string|unique:players,token',
    ];

    protected $perPage = 20;

    protected $fillable = [
        'uuid',
        'sistemas',
        'line',
        'otp',
        'ip',
        'token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($player) {
            $player->uuid = (string) Str::uuid();
        });
    }

}
