<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservering;
use App\Http\Helpers\SharedHelper;
use Carbon\Carbon;

class ReserveringController extends Controller
{
    public function index()
    {
        $reserveringen = Reservering::with(['Persoon', 'Pakketoptie', 'reserveringstatus'])->get();
        
        $reservering = Reservering::whereDate('datum', '2025-01-29')->get();
        
        return view('reservering.index', compact('reserveringen'));
    } 

    public function edit(Reservering $reservering)
    {
        return view('reservering.edit',compact('reservering'));
    }

    public function update(Request $request, Reservering $reservering)
    {
        $aantalKinderen = $reservering->aantalkinderen; // Haal het aantal kinderen op
        $aantalVolwassenen = $reservering->aantalvolwassenen; // Haal het aantal volwassenen op

        $request->validate([
            'pakketoptie_id' => [
                'required',
                function ($attribute, $value, $fail) use ($aantalKinderen) {
                    // Assuming ID 1 is "Kinderfeestje" (children's party)
                    if ($aantalKinderen == 0 && $value == 3) { 
                        $fail('Het optiepakket "kinderfeestje" is niet bedoeld voor volwassenen.');
                    }
                    if ($aantalKinderen > 0 && $value == 4) { // ID 4 is "Vrijgezellenfeest"
                        $fail('Het optiepakket "Vrijgezellenfeest" is niet beschikbaar voor reserveringen met kinderen.');
                    }
                },
            ],
        ]);

        $request->validate([
            'pakketoptie_id' => [
                'required',
                function ($attribute, $value, $fail) use ($aantalVolwassenen) {
                    // Assuming ID 1 is "Kinderpartij" (children's party)
                    if ($aantalVolwassenen > 0 && $value == 1) { 
                        $fail('Het optiepakket "Kinderpartij" is niet geschikt voor reserveringen met volwassenen.');
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
        $datum = $request->input('datum');

        if ($datum) {
            try {
                // Parse the date to ensure it's in the correct format
                $datum = Carbon::createFromFormat('Y-m-d', $datum)->startOfDay();
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['datum' => 'Invalid date format.']);
            }
        }

        // Fetch reservations from the selected date onward and sort by date descending
        $reservering = Reservering::when($datum, function ($query, $datum) {
            return $query->whereDate('datum', '>=', $datum);
        })
            ->orderBy('datum', 'desc')
            ->get();

        return view('reserveringoverzicht.index', compact('reservering'));
    }

} 
