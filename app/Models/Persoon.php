<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persoon extends Model
{

    protected $table = 'persoon';

    public function reserveringen()
    {
        return $this->hasOne(Reservering::class);
    }
}
