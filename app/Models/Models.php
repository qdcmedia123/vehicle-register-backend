<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Models extends Model
{
    use HasFactory;

    /**
     * one model can have many vehicle
     */
    protected $table = "models";
    protected $fillable = ['name', 'seat_count', 'fuel'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
