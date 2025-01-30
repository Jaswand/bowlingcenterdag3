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
        'reserveringsdatum',
        'achternaam',
        'datum',
        'uren',
        'volwassen',
        'status',
        'kinderen',
        'optiepakket',
    ];

    protected $table = 'reservering';

    public function persoon()
    {
        return $this->belongsTo(Persoon::class, 'persoon_id'); // Ensure 'persoon_id' is in your reserveringen table
    }

    public function pakketoptie()
    {
        return $this->belongsTo(Pakketoptie::class);
    }

    public function reserveringstatus()
    {
        return $this->belongsTo(Reserveringstatus::class, 'reserveringstatus_id');
    }
}
