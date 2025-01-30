<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservering extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'voornaam',
        'pakketoptie_id',
        'tussenvoegsel',
        'achternaam',
        'datum',
        'volwassen',
        'kinderen',
        'optiepakket',
    ];

    protected $table = 'reservering';

    public function persoon()
    {
        return $this->belongsTo(Persoon::class);
    }

    public function pakketoptie()
    {
        return $this->belongsTo(Pakketoptie::class);
    }
}
