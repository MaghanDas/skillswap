@extends('layouts.app')

@section('title', 'SkillSwap - Edit Review')

@section('content')
    <div class="bg-gradient-to-r from-orange-600 to-yellow-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✏️ Edit Review</h1>
            <p class="text-orange-100 mt-2">Update your feedback for this session</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="max-w-2xl mx-auto">
            <div class="card bg-base-100 shadow-xl border border-gray-200">
                <div class="card-body">
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

                    <div class="mb-6 p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-bold text-lg mb-2">{{ $review->session->title }}</h3>
                        <p class="text-gray-600">{{ $review->session->skill->name ?? 'Skill' }} • {{ $review->session->session_date }}</p>
                        <p class="text-sm text-gray-500 mt-2">Review submitted on {{ $review->created_at->format('M d, Y') }}</p>
                    </div>

                    <form method="POST" action="{{ url('/reviews/' . $review->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">📊 Rating</span>
                            </label>
                            <div class="rating gap-2 pt-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <input type="radio" name="rating" class="mask mask-star-2 bg-orange-400 cursor-pointer" value="{{ $i }}" {{ old('rating', $review->rating) == $i ? 'checked' : '' }} />
                                @endfor
                            </div>
                            @error('rating')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">💬 Your Review</span>
                            </label>
                            <textarea name="comment" placeholder="Share your experience and feedback..." class="textarea textarea-bordered textarea-lg h-28" required>{{ old('comment', $review->comment) }}</textarea>
                            @error('comment')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Review</button>
                        </div>
                    </form>

                    <div class="divider">OR</div>

                    <form method="POST" action="{{ url('/reviews/' . $review->id) }}" class="text-center">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-error btn-lg font-bold" onclick="return confirm('Are you sure you want to delete this review?')">🗑️ Delete Review</button>
                    </form>
                </div>
            </div>

            <div class="text-center mt-6">
                <a href="/reviews" class="btn btn-outline">← Back to Reviews</a>
            </div>
        </div>
    </div>
@endsection