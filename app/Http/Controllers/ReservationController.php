<?php
namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ride;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;



class ReservationController extends Controller
{
   
    public function create(Request $request,$idTrajet)
    {
        $ride = ride::findOrFail($idTrajet);



        Reservation::create([
            'user_id' => auth()->id(),
            'ride_id' => $idTrajet,
            'statut' => 'pending',
        ]);

        $ride->update([
            'available_seats' => $ride->available_seats - 1,
        ]);
        

        return redirect()->back();
    }


    
    
    

    public function update(Request $request,$id ){

        $validated = $request->validate([
            'user_id'=> 'exists:users,id',
            'ride_id'=> 'exists:rides,id',
            'status'=> 'in:pending,accepted,cancelled,completed',
        ]);

        $reservation = Reservation::findOrFail($id);

        $reservation->update($validated);
        
        return redirect()->back();
    }


}
