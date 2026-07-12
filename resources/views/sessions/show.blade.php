@extends('layouts.app')

@section('title', 'SkillSwap - Session Details')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📅 Session Details</h1>
                    <p class="text-purple-100">{{ $session->title }}</p>
                </div>
                <div class="flex gap-2">
                    @if(auth()->user()->role !== 'student')
                        <a href="/sessions/{{ $session->id }}/edit" class="btn btn-warning btn-lg font-bold">Edit Session</a>
                    @endif
                    <a href="/sessions" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-purple-600">Back to Sessions</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Session Details -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Session Info Card -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <div class="flex justify-between items-start mb-4">
                            <h2 class="card-title text-2xl">{{ $session->title }}</h2>
                            <span class="badge {{
                                $session->status=='pending'?'badge-warning':($session->status=='confirmed'?'badge-info':($session->status=='completed'?'badge-success':'badge-error'))
                            }} badge-lg">
                                {{ ucfirst($session->status) }}
                            </span>
                        </div>

                        <div class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📚</span>
                                    <div>
                                        <p class="font-semibold">Skill</p>
                                        <p class="text-gray-600">{{ $session->skill ? $session->skill->name : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">👨‍🏫</span>
                                    <div>
                                        <p class="font-semibold">Teacher</p>
                                        <p class="text-gray-600">{{ $session->teacher ? $session->teacher->name : 'N/A' }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📍</span>
                                    <div>
                                        <p class="font-semibold">Location</p>
                                        <p class="text-gray-600">{{ $session->location }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">📅</span>
                                    <div>
                                        <p class="font-semibold">Date</p>
                                        <p class="text-gray-600">{{ $session->session_date }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <span class="text-2xl">🕐</span>
                                    <div>
                                        <p class="font-semibold">Time & Duration</p>
                                        <p class="text-gray-600">{{ $session->session_time }} ({{ $session->duration }} minutes)</p>
                                    </div>
                                </div>
                            </div>

                            <div class="divider"></div>

                            <div>
                                <h3 class="font-bold text-lg mb-2">Description</h3>
                                <p class="text-gray-700 leading-relaxed">{{ $session->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                @if(auth()->user()->role === 'student' && ! $myBooking)
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">Book This Session</h3>
                            <p class="text-gray-600">Create your personal booking without affecting any other student.</p>
                            <form action="/sessions/{{ $session->id }}/book" method="POST" class="mt-4">
                                @csrf
                                <button type="submit" class="btn btn-primary">Book Session</button>
                            </form>
                        </div>
                    </div>
                @endif

                @if($myBooking)
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">My Booking</h3>
                            <p class="text-gray-600 mb-4">This status is only for your booking.</p>
                            <form action="/session-bookings/{{ $myBooking->id }}" method="POST" class="space-y-4">
                                @csrf
                                @method('PUT')
                                <div class="form-control">
                                    <label class="label"><span class="label-text font-bold">Booking Status</span></label>
                                    <select name="status" class="select select-bordered select-lg">
                                        <option value="pending" {{ $myBooking->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ $myBooking->status === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        <option value="completed" {{ $myBooking->status === 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $myBooking->status === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Update My Booking</button>
                            </form>
                        </div>
                    </div>
                @endif

                <!-- Reviews Section -->
                @if($session->status == 'completed' || ($myBooking && $myBooking->status == 'completed'))
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-xl">⭐ Reviews</h3>
                            @if($session->reviews->count() > 0)
                                <div class="space-y-4">
                                    @foreach($session->reviews as $review)
                                        <div class="border border-gray-200 rounded-lg p-4">
                                            <div class="flex items-center justify-between mb-2">
                                                <div class="flex items-center gap-2">
                                                    <div class="avatar">
                                                        <div class="w-8 h-8 rounded-full">
                                                            <img src="https://i.pravatar.cc/32?u={{ $review->user->id }}" alt="Reviewer" />
                                                        </div>
                                                    </div>
                                                    <span class="font-semibold">{{ $review->user->name }}</span>
                                                </div>
                                                <div class="rating rating-sm">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        <input type="radio" class="mask mask-star-2 bg-orange-400" {{ $i <= $review->rating ? 'checked' : '' }} disabled />
                                                    @endfor
                                                </div>
                                            </div>
                                            <p class="text-gray-700">{{ $review->comment }}</p>
                                            <p class="text-sm text-gray-500 mt-2">{{ $review->created_at->format('M d, Y') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-600">No reviews yet for this session.</p>
                            @endif

                            @if(auth()->check() && (auth()->user()->role === 'teacher' || $myBooking))
                                <div class="mt-6">
                                    <a href="/reviews" class="btn btn-primary">Write a Review</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Quick Actions -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h3 class="card-title text-lg">Quick Actions</h3>
                        <div class="space-y-2">
                            @if(auth()->user()->role !== 'student')
                                <a href="/sessions/{{ $session->id }}/edit" class="btn btn-primary btn-block">Edit Session</a>
                            @endif
                            @if(auth()->user()->role === 'student' && ! $myBooking)
                                <form action="/sessions/{{ $session->id }}/book" method="POST" class="inline-block w-full">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-block">Book Session</button>
                                </form>
                            @endif
                            @if($myBooking)
                                <form action="/session-bookings/{{ $myBooking->id }}" method="POST" class="inline-block w-full">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="completed">
                                    <button type="submit" class="btn btn-info btn-block">Mark My Booking Completed</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Participants Info -->
                @if($session->teacher)
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-lg">👨‍🏫 Teacher</h3>
                            <div class="flex items-center gap-3">
                                <div class="avatar">
                                    <div class="w-12 h-12 rounded-full">
                                        <img src="https://i.pravatar.cc/48?u={{ $session->teacher->id }}" alt="Teacher" />
                                    </div>
                                </div>
                                <div>
                                    <p class="font-semibold">{{ $session->teacher->name }}</p>
                                    <p class="text-sm text-gray-600">{{ $session->teacher->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                @if($session->bookings->count() > 0)
                    <div class="card bg-base-100 shadow-xl border border-gray-200">
                        <div class="card-body">
                            <h3 class="card-title text-lg">👨‍🎓 Bookings</h3>
                            <div class="space-y-3">
                                @foreach($session->bookings as $booking)
                                    <div class="flex items-center justify-between border border-gray-200 rounded-lg p-3">
                                        <div>
                                            <p class="font-semibold">{{ $booking->user->name }}</p>
                                            <p class="text-sm text-gray-600">{{ $booking->user->email }}</p>
                                        </div>
                                        <span class="badge badge-info">{{ ucfirst($booking->status) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection