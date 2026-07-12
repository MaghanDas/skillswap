@extends('layouts.app')

@section('title', $skill->name . ' - SkillSwap')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">{{ $skill->name }}</h1>
            <p class="text-blue-100 mt-2">{{ $skill->category->name }} • 
                @if($skill->difficulty === 'beginner')
                    🟢 Beginner
                @elseif($skill->difficulty === 'intermediate')
                    🟡 Intermediate
                @else
                    🔴 Advanced
                @endif
            </p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Skill Image & Info -->
                <div class="card bg-base-100 shadow-xl border border-gray-200 mb-8">
                    <div class="card-body">
                        @if($skill->image)
                            <figure class="mb-6">
                                <img src="{{ asset($skill->image) }}" alt="{{ $skill->name }}" class="w-full h-80 object-cover rounded-lg" />
                            </figure>
                        @else
                            <figure class="mb-6">
                                <div class="w-full h-80 bg-gradient-to-br from-blue-200 to-purple-200 flex items-center justify-center rounded-lg">
                                    <span class="text-6xl">📚</span>
                                </div>
                            </figure>
                        @endif

                        <h2 class="card-title text-3xl mb-4">{{ $skill->name }}</h2>
                        
                        <div class="mb-6 space-y-3">
                            <div class="flex items-center gap-3">
                                <span class="badge badge-lg">📂 {{ $skill->category->name }}</span>
                                <span class="badge badge-lg badge-outline">
                                    @if($skill->difficulty === 'beginner')
                                        🟢 Beginner
                                    @elseif($skill->difficulty === 'intermediate')
                                        🟡 Intermediate
                                    @else
                                        🔴 Advanced
                                    @endif
                                </span>
                            </div>
                        </div>

                        <h3 class="text-lg font-bold mb-3">About This Skill</h3>
                        <p class="text-gray-700 leading-relaxed mb-8">{{ $skill->description }}</p>

                        <div class="card-actions">
                            <a href="/sessions" class="btn btn-primary btn-lg font-bold gap-2">
                                <span>📅</span>
                                <span>Book a Session</span>
                            </a>
                            <a href="/sessions" class="btn btn-outline btn-lg">View Sessions</a>
                        </div>
                    </div>
                </div>

                <!-- Reviews Section -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h3 class="card-title text-2xl mb-6">⭐ Reviews ({{ count($reviews) }})</h3>
                        
                        @if(count($reviews) > 0)
                            <div class="space-y-6">
                                @foreach($reviews as $review)
                                    <div class="border-b border-gray-200 pb-6">
                                        <div class="flex items-start justify-between mb-3">
                                            <div>
                                                <h4 class="font-bold text-lg">{{ $review->session->title ?? 'Skill Exchange Session' }}</h4>
                                                <p class="text-sm text-gray-600">{{ $review->created_at->format('M d, Y') }}</p>
                                            </div>
                                            <div class="rating gap-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <input type="radio" class="mask mask-star-2 bg-orange-400" {{ $i <= $review->rating ? 'checked' : '' }} disabled />
                                                @endfor
                                            </div>
                                        </div>
                                        <p class="text-gray-700">{{ $review->comment }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8">
                                <p class="text-3xl mb-3">📝</p>
                                <p class="text-gray-600">No reviews yet. Be the first to review!</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div>
                <!-- Quick Info Card -->
                <div class="card bg-base-100 shadow-xl border border-gray-200 mb-6 sticky top-20">
                    <div class="card-body">
                        <h3 class="card-title mb-4">📋 Skill Details</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Category</p>
                                <p class="text-lg">{{ $skill->category->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Difficulty</p>
                                <p class="text-lg">
                                    @if($skill->difficulty === 'beginner')
                                        🟢 Beginner
                                    @elseif($skill->difficulty === 'intermediate')
                                        🟡 Intermediate
                                    @else
                                        🔴 Advanced
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-gray-600 font-semibold">Posted</p>
                                <p class="text-lg">{{ $skill->created_at->format('M d, Y') }}</p>
                            </div>

                            <div class="divider"></div>

                            <button class="btn btn-primary btn-block btn-lg font-bold gap-2">
                                <span>📅</span>
                                <span>Book Session</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Share Card -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h3 class="card-title mb-4">🔗 Share</h3>
                        <div class="space-y-2">
                            <button class="btn btn-outline btn-block gap-2">
                                <span>f</span> Share on Facebook
                            </button>
                            <button class="btn btn-outline btn-block gap-2">
                                <span>𝕏</span> Share on Twitter
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
