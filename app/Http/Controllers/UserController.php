<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Show all users
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    // Show user profile
    public function show(User $user)
    {
        $teachingSkills = $user->skills()->wherePivot('is_teaching', true)->get();
        $learningSkills = $user->skills()->wherePivot('is_teaching', false)->get();

        if ($user->role === 'teacher') {
            $completedSessions = $user->sessionsAsTeacher()->where('status', 'completed')->count();
            $upcomingSessions = $user->sessionsAsTeacher()->whereIn('status', ['pending', 'confirmed'])
                ->where('session_date', '>=', now()->toDateString())->count();
        } else {
            $completedSessions = $user->sessionBookings()
                ->where('status', 'completed')
                ->whereHas('session', function ($query) {
                    $query->where('session_date', '<=', now()->toDateString());
                })
                ->count();

            $upcomingSessions = $user->sessionBookings()
                ->whereIn('status', ['pending', 'confirmed'])
                ->whereHas('session', function ($query) {
                    $query->where('session_date', '>=', now()->toDateString());
                })
                ->count();
        }

        $reviews = collect();
        if ($user->role === 'teacher') {
            $reviews = \App\Models\Review::whereIn('session_id',
                \App\Models\Session::where('teacher_id', $user->id)->pluck('id')
            )->with('user')->get();
        } else {
            $reviews = \App\Models\Review::where('user_id', $user->id)
                ->with('user')
                ->get();
        }

        $avgRating = $reviews->count() > 0 ? $reviews->avg('rating') : 0;

        return view('users.show', compact('user', 'teachingSkills', 'learningSkills', 'completedSessions', 'upcomingSessions', 'reviews', 'avgRating'));
    }

    // Show edit role form
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    // Update role
    public function update(Request $request, User $user)
    {
        $request->validate([
            'role' => 'required|in:student,teacher,admin'
        ]);

        $user->update([
            'role' => $request->role
        ]);

        return redirect('/users')->with('success', 'User role updated!');
    }

    // Delete user
    public function destroy(User $user)
    {
        $user->delete();
        return redirect('/users')->with('success', 'User deleted!');
    }
}