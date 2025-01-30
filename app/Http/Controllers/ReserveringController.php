<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservering;
use App\Http\Helpers\SharedHelper;

class ReserveringController extends Controller
{
    public function index()
    {
        $reservering = Reservering::with(['Persoon', 'Pakketoptie'])->get();
        
        return view('reservering.index', compact('reservering'));
    } 

    public function edit(Reservering $reservering)
    {
        return view('reservering.edit',compact('reservering'));
    }

    public function update(Request $request, Reservering $reservering)
    {
        $aantalKinderen = $reservering->aantalkinderen; // Haal het aantal kinderen op

        $request->validate([
            'pakketoptie_id' => [
                'required',
                function ($attribute, $value, $fail) use ($aantalKinderen) {
                    if ($aantalKinderen > 0 && $value == 4) { // ID 4 is "Vrijgezellenfeest"
                        $fail('Het optiepakket "Vrijgezellenfeest" is niet beschikbaar voor reserveringen met kinderen.');
                    }
                },
            ],
        ]);

        $request->validate([
            'pakketoptie_id' => ['required', 'integer','max:4'],
        ]);
    

        $reservering->update([
            'pakketoptie_id' => $request->pakketoptie_id,
        ]);
    

        $reservering->save();
                        
        return redirect()->route('reserveren', $reservering->id)->with('success', 'Reservering updated successfully.');
    }

    public function filter(Request $request)
    {
        $reservering = Reservering::with(['Persoon', 'Pakketoptie'])
            ->where('datum', '>=', $request->start_date)
            ->where('datum', '<=', $request->end_date)
            ->get();
        
        return view('reservering.index', compact('reservering'));
    }

} 
