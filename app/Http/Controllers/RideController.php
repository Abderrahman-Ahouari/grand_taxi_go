<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RideController extends Controller
{

    public function create(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'start_location' => 'required|string|max:255',
            'end_location' => 'required|string|max:255',
            'departure_day' => 'required|date',
            'departure_time' => 'required|date_format:H:i',
            'available_seats' => 'required|integer',
            'price' => 'required|integer',
            'status' => 'required|in:open,full,cancelled',
        ]);
    

        $ride = Ride::create($validated);
    

        return redirect()->back();
    }    


    public function update(Request $request, $id)
    {
        $ride = ride::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'exists:users,id',
            'start_location' => 'string|max:255',
            'end_location' => 'string|max:255',
            'departure_day' => 'date',
            'departure_time' => 'date_format:H:i',
            'available_seats' => 'integer',
            'price' => 'integer',
            'status' => 'in:open,full,cancelled',
        ]);

        $ride->update($validated);
        
        return redirect()->back();

    }


    public function destroy($id){
        $ride = ride::findOrFail($id);

        $ride->delete();

        return redirect()->back();
    }
    
    
    public function getRides(){
        $rides = ride::all();

        return view('ridesCatalogue', compact($rides));
    }


}
