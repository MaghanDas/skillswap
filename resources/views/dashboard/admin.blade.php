@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">🎛️ Admin Dashboard</h1>
            <p class="text-red-100 mt-2">Platform overview and management</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <!-- Key Statistics -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 font-semibold">Total Users</p>
                            <h3 class="text-4xl font-bold text-blue-600">{{ $totalUsers }}</h3>
                        </div>
                        <span class="text-5xl">👥</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        🎓 {{ $totalStudents }} Students | 👨‍🏫 {{ $totalTeachers }} Teachers
                    </div>
                </div>
            </div>

            <!-- Total Skills -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 font-semibold">Total Skills</p>
                            <h3 class="text-4xl font-bold text-green-600">{{ $totalSkills }}</h3>
                        </div>
                        <span class="text-5xl">🎯</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        In {{ $totalCategories }} categories
                    </div>
                </div>
            </div>

            <!-- Total Sessions -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 font-semibold">Total Sessions</p>
                            <h3 class="text-4xl font-bold text-purple-600">{{ $totalSessions }}</h3>
                        </div>
                        <span class="text-5xl">📅</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        ✅ {{ $completedSessions }} Completed
                    </div>
                </div>
            </div>

            <!-- Average Rating -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 font-semibold">Average Rating</p>
                            <h3 class="text-4xl font-bold text-orange-600">{{ number_format($avgRating, 1) }}/5</h3>
                        </div>
                        <span class="text-5xl">⭐</span>
                    </div>
                    <div class="mt-4 text-sm text-gray-600">
                        From {{ $totalReviews }} reviews
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Recent Users -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <h2 class="card-title mb-6">👥 Recent Users</h2>
                    <div class="space-y-4">
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                                <div>
                                    <p class="font-semibold">{{ $user->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                </div>
                                <span class="badge {{ $user->role === 'admin' ? 'badge-error' : ($user->role === 'teacher' ? 'badge-info' : 'badge-success') }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <a href="/users" class="btn btn-outline btn-block mt-4">View All Users</a>
                </div>
            </div>

            <!-- Recent Sessions -->
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
                    <h2 class="card-title mb-6">📅 Recent Sessions</h2>
                    <div class="space-y-4">
                        @foreach($recentSessions as $session)
                            <div class="p-3 bg-gray-50 rounded-lg">
                                <p class="font-semibold">{{ $session->title }}</p>
                                <p class="text-sm text-gray-600">{{ $session->skill->name ?? 'Skill' }} • {{ $session->session_date }}</p>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs">{{ $session->teacher->name ?? 'N/A' }} → {{ $session->student->name ?? 'N/A' }}</span>
                                    <span class="badge {{ $session->status === 'completed' ? 'badge-success' : ($session->status === 'confirmed' ? 'badge-info' : 'badge-warning') }}">
                                        {{ ucfirst($session->status) }}
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="/sessions" class="btn btn-outline btn-block mt-4">View All Sessions</a>
                </div>
            </div>
        </div>

        <!-- Management Links -->
        <div class="mt-8">
            <h2 class="text-2xl font-bold mb-6">🎛️ Management Tools</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="/categories" class="card bg-gradient-to-br from-green-500 to-emerald-500 text-white shadow-xl hover:shadow-2xl transition-all">
                    <div class="card-body">
                        <h3 class="card-title text-white">🏷️ Categories</h3>
                        <p>Manage skill categories</p>
                        <div class="card-actions mt-4">
                            <span class="btn btn-sm btn-ghost text-white">Manage →</span>
                        </div>
                    </div>
                </a>

                <a href="/skills" class="card bg-gradient-to-br from-blue-500 to-purple-500 text-white shadow-xl hover:shadow-2xl transition-all">
                    <div class="card-body">
                        <h3 class="card-title text-white">🎯 Skills</h3>
                        <p>Manage platform skills</p>
                        <div class="card-actions mt-4">
                            <span class="btn btn-sm btn-ghost text-white">Manage →</span>
                        </div>
                    </div>
                </a>

                <a href="/users" class="card bg-gradient-to-br from-red-500 to-pink-500 text-white shadow-xl hover:shadow-2xl transition-all">
                    <div class="card-body">
                        <h3 class="card-title text-white">👥 Users</h3>
                        <p>Manage users and roles</p>
                        <div class="card-actions mt-4">
                            <span class="btn btn-sm btn-ghost text-white">Manage →</span>
                        </div>
                    </div>
                </a>

                <a href="/sessions" class="card bg-gradient-to-br from-orange-500 to-yellow-500 text-white shadow-xl hover:shadow-2xl transition-all">
                    <div class="card-body">
                        <h3 class="card-title text-white">📅 Sessions</h3>
                        <p>View all sessions</p>
                        <div class="card-actions mt-4">
                            <span class="btn btn-sm btn-ghost text-white">Manage →</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
@endsection