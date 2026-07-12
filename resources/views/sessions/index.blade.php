@extends('layouts.app')

@section('title', 'SkillSwap - Sessions')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📅 Sessions</h1>
                    <p class="text-purple-100">Manage your learning and teaching sessions</p>
                </div>
                @if(auth()->user()->role !== 'student')
                    <a href="/sessions/create" class="btn btn-warning btn-lg font-bold">+ Schedule Session</a>
                @endif
            </div>
        </div>
    </div>

    <!-- Sessions Grid -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($sessions as $s)
                @php
                    $myBooking = auth()->user()->role === 'student' ? $s->bookings->first() : null;
                @endphp
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200 overflow-hidden">
                    <div class="card-body">
                        <div class="flex justify-between items-start mb-3">
                            <h2 class="card-title text-xl">{{ $s->title }}</h2>
                            <span class="badge {{ $myBooking ? ($myBooking->status=='pending'?'badge-warning':($myBooking->status=='confirmed'?'badge-info':($myBooking->status=='completed'?'badge-success':'badge-error'))) : ($s->status=='pending'?'badge-warning':($s->status=='confirmed'?'badge-info':($s->status=='completed'?'badge-success':'badge-error'))) }}">
                                {{ $myBooking ? 'My ' . ucfirst($myBooking->status) : ucfirst($s->status) }}
                            </span>
                        </div>

                        <div class="space-y-2 text-sm text-gray-600">
                            <p class="flex items-center gap-2"><span>📚</span> {{ $s->skill ? $s->skill->name : 'N/A' }}</p>
                            <p class="flex items-center gap-2"><span>👨‍🏫</span> Teacher: <strong>{{ $s->teacher ? $s->teacher->name : 'N/A' }}</strong></p>
                            <p class="flex items-center gap-2"><span>📍</span> {{ $s->location }}</p>
                            <p class="flex items-center gap-2"><span>📅</span> {{ $s->session_date }}</p>
                            <p class="flex items-center gap-2"><span>🕐</span> {{ $s->session_time }} ({{ $s->duration }} mins)</p>
                        </div>
                        
                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="/sessions/{{ $s->id }}" class="btn btn-sm btn-info">👁️ View</a>
                            @if(auth()->user()->role === 'student')
                                @if($myBooking)
                                    <a href="/sessions/{{ $s->id }}" class="btn btn-sm btn-primary">Update Booking</a>
                                @else
                                    <form action="/sessions/{{ $s->id }}/book" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Book Session</button>
                                    </form>
                                @endif
                            @else
                                <a href="/sessions/{{ $s->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                                <form action="/sessions/{{ $s->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if(isset($myBookings) && $myBookings->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-4">My Booked Sessions</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($myBookings as $booking)
                        <div class="card bg-base-100 shadow-xl border border-gray-200">
                            <div class="card-body">
                                <h3 class="card-title text-lg">{{ $booking->session->title }}</h3>
                                <p class="text-sm text-gray-600">👨‍🏫 {{ $booking->session->teacher->name }}</p>
                                <p class="text-sm text-gray-600">📚 {{ $booking->session->skill->name }}</p>
                                <p class="text-sm text-gray-600">📅 {{ $booking->session->session_date }} at {{ $booking->session->session_time }}</p>
                                <div class="card-actions justify-between items-center mt-4">
                                    <span class="badge badge-info">{{ ucfirst($booking->status) }}</span>
                                    <a href="/sessions/{{ $booking->session->id }}" class="btn btn-sm btn-primary">Open</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($sessions->isEmpty())
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No sessions yet.</p>
                @if(auth()->user()->role !== 'student')
                    <a href="/sessions/create" class="btn btn-primary mt-4">Create Your First Session</a>
                @else
                    <a href="/skills" class="btn btn-primary mt-4">Browse Skills</a>
                @endif
            </div>
        @endif
    </div>
@endsection