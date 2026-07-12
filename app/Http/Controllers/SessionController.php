<?php

namespace App\Http\Controllers;

use App\Models\Session;
use App\Models\SessionBooking;
use App\Models\User;
use App\Models\Skill;
use Illuminate\Http\Request;

class SessionController extends Controller
{
public function index()
{
    if (auth()->user()->isTeacher()) {
        $sessions = Session::with(['skill', 'bookings.user'])
            ->where('teacher_id', auth()->id())
            ->latest()
            ->get();

        return view('sessions.index', compact('sessions'));
    }

    if (auth()->user()->isStudent()) {
        $sessions = Session::with(['skill', 'teacher', 'bookings' => function ($query) {
            $query->where('user_id', auth()->id());
        }])
            ->whereNull('student_id')
            ->latest()
            ->get();

        $myBookings = auth()->user()->sessionBookings()
            ->with(['session.skill', 'session.teacher'])
            ->latest()
            ->get();

        return view('sessions.index', compact('sessions', 'myBookings'));
    }

    $sessions = Session::with(['skill', 'teacher', 'bookings.user'])->latest()->get();

    return view('sessions.index', compact('sessions'));
}

    public function create()
    {
        $skills = Skill::all();

        return view('sessions.create', compact('skills'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:1000',
            'skill_id' => 'required|exists:skills,id',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|min:3|max:255',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $validated['teacher_id'] = auth()->id();
        $validated['student_id'] = null;

        Session::create($validated);

        return redirect('/sessions')->with('success', 'Session created successfully!');
    }

    public function show(Session $session)
    {
        if (!$this->canViewSession($session)) {
            abort(403, 'Unauthorized access to session');
        }

        $session->load(['skill', 'teacher', 'reviews.user', 'bookings.user']);

        $myBooking = auth()->user()->isStudent()
            ? $session->bookings->firstWhere('user_id', auth()->id())
            : null;

        return view('sessions.show', compact('session', 'myBooking'));
    }

    public function edit(Session $session)
    {
        if (!$this->canManageSession($session)) {
            abort(403, 'Unauthorized access to session');
        }

        $skills = Skill::all();

        return view('sessions.edit', compact('session', 'skills'));
    }

    public function update(Request $request, Session $session)
    {
        if (!$this->canManageSession($session)) {
            abort(403, 'Unauthorized access to session');
        }

        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'description' => 'required|min:5|max:1000',
            'skill_id' => 'required|exists:skills,id',
            'session_date' => 'required|date',
            'session_time' => 'required',
            'duration' => 'required|integer|min:1',
            'location' => 'required|string|min:3|max:255',
            'status' => 'required|in:pending,confirmed,completed,cancelled',
        ]);

        $validated['teacher_id'] = $session->teacher_id;
        $validated['student_id'] = null;

        $session->update($validated);

        return redirect('/sessions')->with('success', 'Session updated successfully!');
    }

    public function destroy(Session $session)
    {
        if (!$this->canManageSession($session)) {
            abort(403, 'Unauthorized access to session');
        }

        $session->delete();

        return redirect('/sessions');
    }

    private function canViewSession(Session $session): bool
    {
        return auth()->user()->isAdmin()
            || $session->teacher_id === auth()->id()
            || $session->student_id === null
            || $session->bookings()->where('user_id', auth()->id())->exists();
    }

    private function canManageSession(Session $session): bool
    {
        return auth()->user()->isAdmin() || $session->teacher_id === auth()->id();
    }
}