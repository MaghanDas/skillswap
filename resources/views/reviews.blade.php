@extends('layouts.app')

@section('title', 'SkillSwap - Reviews')

@section('content')
    <div class="bg-gradient-to-r from-orange-600 to-yellow-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">⭐ My Reviews</h1>
            <p class="text-orange-100 mt-2">Share and view feedback from skill exchange sessions</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <!-- Review Form Section -->
        <div class="mb-12">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-2xl font-bold mb-6">✍️ Submit a New Review</h2>
                
                @if ($errors->any())
                    <div class="alert alert-error mb-6">
                        <div class="flex items-start gap-2">
                            <span>⚠️</span>
                            <ul class="list-disc list-inside">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <form method="POST" action="{{ url('/reviews') }}" class="space-y-6">
                            @csrf

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">Session/Partner</span>
                                </label>
                                <select name="session_id" class="select select-bordered select-lg" required>
                                    <option disabled {{ old('session_id') ? '' : 'selected' }}>Select Session or Partner</option>
                                    @foreach($sessions as $session)
                                        <option value="{{ $session->id }}" {{ old('session_id') == $session->id ? 'selected' : '' }}>
                                            {{ $session->title }} - {{ $session->skill->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('session_id')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📊 Rating</span>
                                </label>
                                <div class="rating gap-2 pt-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <input type="radio" name="rating" class="mask mask-star-2 bg-orange-400 cursor-pointer" value="{{ $i }}" {{ old('rating') == $i ? 'checked' : '' }} />
                                    @endfor
                                </div>
                                @error('rating')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">💬 Your Review</span>
                                </label>
                                <textarea name="comment" placeholder="Share your experience and feedback..." class="textarea textarea-bordered textarea-lg h-28" required>{{ old('comment') }}</textarea>
                                @error('comment')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <button type="submit" class="btn btn-primary btn-lg font-bold">⭐ Submit Review</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reviews Display Section -->
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl font-bold mb-6">📝 Your Reviews</h2>
            
            @if(isset($reviews) && count($reviews) > 0)
                <div class="space-y-6">
                    @foreach($reviews as $review)
                        <div class="card bg-base-100 shadow-lg border border-gray-200 hover:shadow-xl transition-all">
                            <div class="card-body">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex-1">
                                        <h4 class="font-bold text-lg">{{ $review->session->title ?? 'Session' }}</h4>
                                        <p class="text-gray-600 text-sm">{{ $review->session->skill->name ?? 'Skill' }} • {{ $review->created_at->format('M d, Y') }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <div class="rating gap-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <input type="radio" class="mask mask-star-2 bg-orange-400" {{ $i <= $review->rating ? 'checked' : '' }} disabled />
                                            @endfor
                                        </div>
                                        <div class="dropdown dropdown-end">
                                            <label tabindex="0" class="btn btn-sm btn-ghost btn-circle">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01"></path>
                                                </svg>
                                            </label>
                                            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-32">
                                                <li><a href="/reviews/{{ $review->id }}/edit" class="text-blue-600">✏️ Edit</a></li>
                                                <li>
                                                    <form action="/reviews/{{ $review->id }}" method="POST" class="w-full">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 w-full text-left" onclick="return confirm('Delete this review?')">🗑️ Delete</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-gray-700 text-base leading-relaxed">{{ $review->comment }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="card bg-base-100 shadow-lg border border-gray-200 text-center">
                    <div class="card-body py-12">
                        <p class="text-5xl mb-4">📝</p>
                        <p class="text-gray-600 text-lg font-semibold">No reviews yet</p>
                        <p class="text-gray-500">Complete a session and share your feedback!</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection