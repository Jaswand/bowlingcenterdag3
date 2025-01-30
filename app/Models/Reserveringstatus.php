<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reserveringstatus extends Model
{
    use HasFactory;

    protected $table = 'reserveringstatus';

    public function reservering()
    {
        return $this->hasMany(Reservering::class, 'status_id');
    }
}
