<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReservationRequest;
use App\Http\Requests\UpdateReservationRequest;
use App\Models\Reservation;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use App\Models\Event;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reservations = Reservation::Where('status', 'In progress')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.reservations.index')->with('reservations', $reservations);
    }

    public function confirmed()
    {
        $reservations = Reservation::where('status', 'Confirmed')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.reservations.confirmed')->with('reservations', $reservations);
    }


    public function rejected()
    {
        $reservations = Reservation::where('status', 'Rejected')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.reservations.rejected')->with('reservations', $reservations);
    }

    public function allreserv()
    {
        $reservations = Reservation::orderBy('created_at', 'desc')->get();
        return view('admin.reservations.all')->with('reservations', $reservations);
    }

    public function usereservation()
    {
        // Get the email of the currently authenticated user
        $userEmail = auth()->user()->email;

        // Fetch reservations where the user's email matches the reservation's email
        // and the status is either 'In Progress' or 'Confirmed'
        $currentDate = now();
        $currentReservations = Reservation::where('email', $userEmail)
            ->where('status', 'In Progress')
            ->orWhere(function ($query) use ($userEmail, $currentDate) {
                $query->where('email', $userEmail)
                    ->where('status', 'Confirmed')
                    ->where('date', '>=', $currentDate);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch previous reservations (Confirmed reservations after the reservation date or Cancelled reservations)
        $previousReservations = Reservation::where('email', $userEmail)
            ->where(function ($query) use ($currentDate) {
                $query->where('status', 'Cancelled')
                    ->orWhere('status', 'Rejected')
                    ->orWhere(function ($query) use ($currentDate) {
                        $query->where('status', 'Confirmed')
                            ->where('date', '<', $currentDate);
                    });
            })
            ->orderBy('created_at', 'desc')
            ->get();

        // Fetch events
        $events = Event::orderBy('date', 'desc')->get();

        // Return the view with the reservations and events
        return view('dashboard', compact('currentReservations', 'previousReservations', 'events'));
    }




    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);

        $reservation->update([
            'number_of_guests' => $request->input('number_of_guests'),
            'date'             => $request->input('date'),
            'time'             => $request->input('time'),
            'status'           => 'In Progress', // Set status to In Progress
        ]);

        return back()->with('message', 'Reservation updated successfully.');
    }


    public function cancel($id)
    {
        // Find the reservation by its ID
        $reservation = Reservation::findOrFail($id);

        // Update the status to 'Cancelled'
        $reservation->update(['status' => 'Cancelled']);

        // Redirect back with a success message
        return redirect()->back()->with('message', 'Reservation cancelled successfully.');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReservationRequest $request)
    {
        $data = $request->validated();

        // Check the date format from the request data


        // Convert date format from 'd.m.Y' to 'Y-m-d'
        $data['date'] = \Carbon\Carbon::createFromFormat('d.m.Y', $data['date'])->format('Y-m-d');

        // Check the converted date format


        // Create a new reservation record using the modified data
        Reservation::create($data);

        // Redirect back with a success message
        return back()->with('message', 'Message sent successfully');
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:In Progress,Confirmed,Rejected',
        ]);

        $reservation = Reservation::findOrFail($id);
        $reservation->status = $request->status;
        $reservation->save();

        return back()->with('message', 'Reservation status updated successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation)
    {
        //
    }
}
