<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\SessionBooking;
use Illuminate\Http\Request;

class SessionBookingController extends Controller
{
    public function store(Session $session)
    {
        if (!auth()->user()->isStudent()) {
            abort(403, 'Only students can book sessions');
        }

        if ($session->teacher_id === auth()->id()) {
            abort(403, 'Teachers cannot book their own sessions');
        }

        $booking = SessionBooking::firstOrCreate(
            [
                'session_id' => $session->id,
                'user_id' => auth()->id(),
            ],
            [
                'status' => 'pending',
            ]
        );

        $message = $booking->wasRecentlyCreated
            ? 'Session booked successfully!'
            : 'You already booked this session.';

        return redirect('/sessions/' . $session->id)->with('success', $message);
    }

    public function update(Request $request, SessionBooking $sessionBooking)
    {
        if ($sessionBooking->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $sessionBooking->update($validated);

        return redirect('/sessions/' . $sessionBooking->session_id)->with('success', 'Booking status updated successfully!');
    }

    public function destroy(SessionBooking $sessionBooking)
    {
        if ($sessionBooking->user_id !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized');
        }

        $sessionId = $sessionBooking->session_id;
        $sessionBooking->delete();

        return redirect('/sessions/' . $sessionId)->with('success', 'Booking cancelled successfully!');
    }
}