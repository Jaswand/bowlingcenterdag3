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

        $request->validate([
            'pakketoptie_id' => ['required', 'integer','max:4'],
        ]);
    

        $reservering->update([
            'pakketoptie_id' => $request->pakketoptie_id,
        ]);

        $reservering->save();
                        
        return redirect()->route('reserveren', $reservering->id)->with('success', 'Reservering updated successfully.');
    }

} 
