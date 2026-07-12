@extends('layouts.app')

@section('content')

<div class="container mx-auto">
    <h1 class="text-4xl font-bold mb-2">Welcome, {{ auth()->user()->name }}! 👋</h1>
    <p class="text-gray-600 mb-8">Student Learning Dashboard</p>

    <!-- Stats Row -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="card bg-blue-50 shadow-md p-6">
            <div class="text-3xl font-bold text-blue-600">{{ $upcomingSessions->count() }}</div>
            <p class="text-gray-600 text-sm mt-2">Upcoming Sessions</p>
        </div>
        <div class="card bg-green-50 shadow-md p-6">
            <div class="text-3xl font-bold text-green-600">{{ $completedSessions->count() }}</div>
            <p class="text-gray-600 text-sm mt-2">Sessions Completed</p>
        </div>
        <div class="card bg-purple-50 shadow-md p-6">
            <div class="text-3xl font-bold text-purple-600">{{ $mySkills->count() }}</div>
            <p class="text-gray-600 text-sm mt-2">Skills Learning</p>
        </div>
        <div class="card bg-orange-50 shadow-md p-6">
            <div class="text-3xl font-bold text-orange-600">{{ $totalHours }}</div>
            <p class="text-gray-600 text-sm mt-2">Hours Learned</p>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left Sidebar -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Upcoming Sessions -->
            <div class="card bg-base-100 shadow-md p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-semibold">📅 Upcoming Sessions</h2>
                    <a href="/sessions" class="btn btn-sm btn-outline">View All</a>
                </div>
                @if($upcomingSessions->count() > 0)
                    <div class="space-y-3">
                        @foreach($upcomingSessions->take(3) as $session)
                            <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="font-bold text-lg">{{ $session->title }}</h3>
                                        <p class="text-sm text-gray-600">👨‍🏫 {{ $session->teacher->name }}</p>
                                        <p class="text-sm text-gray-600">📚 {{ $session->skill->name ?? 'N/A' }}</p>
                                        <p class="text-sm text-blue-600 mt-2">🕐 {{ $session->session_date }} at {{ $session->session_time }}</p>
                                    </div>
                                    <span class="badge badge-info">{{ ucfirst($session->status) }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-center py-6">No upcoming sessions. Browse available sessions below!</p>
                    <a href="/sessions" class="btn btn-primary w-full">Browse Sessions</a>
                @endif
            </div>

            <!-- Browse Sessions -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-2xl font-semibold mb-4">🔍 Browse Available Sessions</h2>
                <p class="text-gray-600 mb-4">Find and enroll in sessions from experienced teachers</p>
                <a href="/sessions" class="btn btn-primary w-full">Explore Sessions</a>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="space-y-6">
            <!-- My Skills Learning -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">📚 Skills I'm Learning</h2>
                @if($mySkills->count() > 0)
                    <div class="space-y-2">
                        @foreach($mySkills as $skill)
                            <div class="flex items-center justify-between p-2 bg-gray-50 rounded">
                                <span class="font-medium">{{ $skill->name }}</span>
                                <span class="badge">{{ ucfirst($skill->pivot->experience_level) }}</span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm text-center py-4">No skills selected yet</p>
                @endif
                <a href="/my-skills" class="btn btn-outline btn-sm w-full mt-4">Manage Skills</a>
            </div>

            <!-- Recent Reviews -->
            <div class="card bg-base-100 shadow-md p-6">
                <h2 class="text-xl font-semibold mb-4">⭐ Reviews</h2>
                @if($reviews->count() > 0)
                    <div class="space-y-3">
                        @foreach($reviews->take(2) as $review)
                            <div class="border-l-4 border-yellow-400 p-3 bg-yellow-50 rounded">
                                <div class="flex gap-1">
                                    @for($i = 0; $i < $review->rating; $i++)
                                        <span class="text-yellow-400">★</span>
                                    @endfor
                                </div>
                                <p class="text-sm text-gray-700 mt-2">"{{ Str::limit($review->comment, 80) }}"</p>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-gray-500 text-sm text-center py-4">No reviews yet. Complete sessions to receive reviews!</p>
                @endif
                <a href="/reviews" class="btn btn-outline btn-sm w-full mt-4">View All Reviews</a>
            </div>
        </div>
    </div>
</div>

@endsection