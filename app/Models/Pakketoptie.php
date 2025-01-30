<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pakketoptie extends Model
{

    protected $table = 'pakketoptie';

    public function reserveringen()
    {
        return $this->hasOne(Reservering::class);
    }
}
