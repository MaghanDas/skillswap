<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Session;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index()
    {
        $sessions = Session::where('teacher_id', auth()->id())
            ->orWhereHas('bookings', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('skill')
            ->get();

        $reviews = Review::with(['session' => function($q) {
            $q->with(['skill', 'teacher', 'bookings.user']);
        }])
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('reviews', compact('sessions', 'reviews'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:skill_sessions,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5',
        ]);

        $session = Session::findOrFail($request->session_id);

        $hasBooking = $session->bookings()->where('user_id', auth()->id())->exists();
        $completedBooking = $session->bookings()
            ->where('user_id', auth()->id())
            ->where('status', 'completed')
            ->exists();

        if ($session->teacher_id !== auth()->id() && ! $hasBooking) {
            abort(403, 'You can only review your own sessions');
        }

        if ($session->teacher_id !== auth()->id() && ! $completedBooking) {
            abort(403, 'You can only review a session after completing your booking');
        }

        Review::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'session_id' => $request->session_id,
            ],
            [
                'rating' => $request->rating,
                'comment' => $request->comment,
            ]
        );

        return redirect('/reviews')->with('success', 'Review submitted successfully!');
    }

    public function edit(Review $review)
    {
        // Check if user owns this review
        if (auth()->id() !== $review->user_id) {
            abort(403, 'You can only edit your own reviews');
        }

        return view('reviews.edit', compact('review'));
    }

    public function update(Request $request, Review $review)
    {
        // Check if user owns this review
        if (auth()->id() !== $review->user_id) {
            abort(403, 'You can only edit your own reviews');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|min:5',
        ]);

        $review->update($request->all());

        return redirect('/reviews')->with('success', 'Review updated successfully!');
    }

    public function destroy(Review $review)
    {
        // Check if user owns this review
        if (auth()->id() !== $review->user_id) {
            abort(403, 'You can only delete your own reviews');
        }

        $review->delete();

        return redirect('/reviews')->with('success', 'Review deleted successfully!');
    }
}
