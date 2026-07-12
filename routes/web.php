<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SessionBookingController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSkillController;
use App\Models\Category;
use App\Models\Review;
use App\Models\Session;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

// Public category viewing
Route::get('/categories', [CategoryController::class, 'index']);

// Public skill browsing
Route::get('/skills', [SkillController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/skills/create', [SkillController::class, 'create']);
    Route::post('/skills', [SkillController::class, 'store']);
    Route::get('/skills/{skill}/edit', [SkillController::class, 'edit']);
    Route::put('/skills/{skill}', [SkillController::class, 'update']);
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy']);

    Route::get('/user-skills', [UserSkillController::class, 'index']);
    Route::get('/my-skills', [UserSkillController::class, 'mySkills']);
    Route::get('/user-skills/create', [UserSkillController::class, 'create']);
    Route::post('/user-skills', [UserSkillController::class, 'store']);
    Route::get('/user-skills/{userSkill}/edit', [UserSkillController::class, 'edit']);
    Route::put('/user-skills/{userSkill}', [UserSkillController::class, 'update']);
    Route::delete('/user-skills/{userSkill}', [UserSkillController::class, 'destroy']);

    Route::get('/sessions', [SessionController::class, 'index']);
    Route::get('/sessions/create', [SessionController::class, 'create'])->middleware('role:teacher');
    Route::post('/sessions', [SessionController::class, 'store']);
    Route::get('/sessions/{session}', [SessionController::class, 'show']);
    Route::get('/sessions/{session}/edit', [SessionController::class, 'edit']);
    Route::put('/sessions/{session}', [SessionController::class, 'update']);
    Route::delete('/sessions/{session}', [SessionController::class, 'destroy']);
    Route::post('/sessions/{session}/book', [SessionBookingController::class, 'store']);
    Route::put('/session-bookings/{sessionBooking}', [SessionBookingController::class, 'update']);
    Route::delete('/session-bookings/{sessionBooking}', [SessionBookingController::class, 'destroy']);

    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit']);
    Route::put('/reviews/{review}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy']);
    Route::get('/reviews', [ReviewController::class, 'index']);
});

Route::get('/skills/{skill}', [SkillController::class, 'show']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/categories/create', [CategoryController::class, 'create']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category}/edit', [CategoryController::class, 'edit']);
    Route::put('/categories/{category}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category}', [CategoryController::class, 'destroy']);
});

Route::get('/categories/{category}', [CategoryController::class, 'show']);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{user}', [UserController::class, 'show']);
    Route::get('/users/{user}/edit', [UserController::class, 'edit']);
    Route::put('/users/{user}', [UserController::class, 'update']);
    Route::delete('/users/{user}', [UserController::class, 'destroy']);
});

Route::get('/', function () {
    return view('home');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        $totalUsers = User::count();
        $totalStudents = User::where('role', 'student')->count();
        $totalTeachers = User::where('role', 'teacher')->count();
        $totalSkills = Skill::count();
        $totalCategories = Category::count();
        $totalSessions = Session::count();
        $completedSessions = Session::where('status', 'completed')->count();
        $totalReviews = Review::count();
        $avgRating = $totalReviews > 0 ? Review::avg('rating') : 0;

        $recentUsers = User::latest()->take(5)->get();
        $recentSessions = Session::with(['teacher', 'student', 'skill'])->latest()->take(5)->get();

        return view('dashboard.admin', compact(
            'totalUsers',
            'totalStudents',
            'totalTeachers',
            'totalSkills',
            'totalCategories',
            'totalSessions',
            'completedSessions',
            'totalReviews',
            'avgRating',
            'recentUsers',
            'recentSessions'
        ));
    } elseif ($user->role === 'teacher') {
        $upcomingSessions = Session::where('teacher_id', $user->id)
            ->where(function ($q) {
                $q->where('session_date', '>', now()->toDateString())
                    ->orWhere(function ($query) {
                        $query->where('session_date', now()->toDateString())
                            ->where('session_time', '>=', now()->format('H:i'));
                    });
            })
            ->get();

        $completedSessions = Session::where('teacher_id', $user->id)
            ->where('status', 'completed')
            ->get();

        $totalHours = $completedSessions->sum('duration') / 60;

        $teachingSkills = $user->skills()
            ->wherePivot('is_teaching', true)
            ->get();

        $reviews = Review::whereIn('session_id', Session::where('teacher_id', $user->id)->pluck('id'))->get();

        $avgRating = $reviews->count() > 0 ? $reviews->avg('rating') : 0;

        return view('dashboard.teacher', compact('upcomingSessions', 'completedSessions', 'totalHours', 'teachingSkills', 'reviews', 'avgRating'));
    }

        $upcomingBookings = $user->sessionBookings()
            ->with(['session.teacher', 'session.skill'])
            ->whereIn('status', ['pending', 'confirmed'])
            ->whereHas('session', function ($query) {
                $query->where('session_date', '>=', now()->toDateString());
            })
            ->get();

        $completedBookings = $user->sessionBookings()
            ->with(['session.teacher', 'session.skill'])
            ->where('status', 'completed')
            ->whereHas('session', function ($query) {
                $query->where('session_date', '<=', now()->toDateString());
            })
            ->get();

        $upcomingSessions = $upcomingBookings->pluck('session');
        $completedSessions = $completedBookings->pluck('session');

        $totalHours = $completedSessions->sum('duration') / 60;

    $mySkills = $user->skills()
        ->wherePivot('is_teaching', false)
        ->get();

        $reviews = Review::where('user_id', $user->id)->get();

    return view('dashboard.student', compact('upcomingSessions', 'completedSessions', 'totalHours', 'mySkills', 'reviews'));
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
