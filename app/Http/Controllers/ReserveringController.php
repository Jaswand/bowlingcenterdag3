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
        
        return view('reservering.index', compact('reserveringen'));
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
        $datum = $request->input('datum');

        // If a date was selected but is empty in the database
        if ($datum && Reservering::whereDate('datum', '>=', $datum)->count() === 0) {
            return redirect()->back()->with('error', 'Er is geen reserveringsinformatie beschikbaar voor deze geselecteerde datum');
        }

        if ($datum) {
            try {
                $datum = Carbon::createFromFormat('Y-m-d', $datum)->format('Y-m-d');
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['datum' => 'Invalid date format.']);
            }
        }

        // Fetch reservations based on the selected date and sort by date descending
        $reservering = Reservering::when($datum, function ($query, $datum) {
            return $query->whereDate('datum', '>=', $datum);
        })
            ->orderBy('datum', 'desc')
            ->get();

        return view('reserveringoverzicht.index', compact('reservering'));
    }

} 
