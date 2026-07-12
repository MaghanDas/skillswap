@extends('layouts.app')

@section('title', 'SkillSwap - {{ $category->name }} Skills')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📚 {{ $category->name }}</h1>
                    <p class="text-blue-100">{{ $category->description }}</p>
                </div>
                <a href="/categories" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-blue-600">Back to Categories</a>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($skills as $skill)
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200 overflow-hidden group">
                    @if($skill->image)
                        <figure class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $skill->image) }}" alt="{{ $skill->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" />
                        </figure>
                    @else
                        <figure class="h-48 bg-gradient-to-br from-blue-500 to-purple-500 flex items-center justify-center text-white text-6xl">
                            📖
                        </figure>
                    @endif

                    <div class="card-body">
                        <h2 class="card-title text-xl font-bold">{{ $skill->name }}</h2>
                        <p class="text-gray-600 line-clamp-2">{{ $skill->description }}</p>

                        <div class="flex items-center justify-between mt-4">
                            <div class="flex gap-2">
                                <div class="badge badge-info">{{ $skill->category->name }}</div>
                                <div class="badge badge-outline">{{ ucfirst($skill->difficulty) }}</div>
                            </div>
                        </div>

                        <!-- Show teachers who teach this skill -->
                        @if($skill->users->count() > 0)
                            <div class="mt-4">
                                <p class="text-sm font-semibold text-gray-700 mb-2">👨‍🏫 Teachers:</p>
                                <div class="flex flex-wrap gap-2">
                                    @foreach($skill->users->take(3) as $teacher)
                                        <div class="badge badge-primary badge-sm">{{ $teacher->name }}</div>
                                    @endforeach
                                    @if($skill->users->count() > 3)
                                        <div class="badge badge-ghost badge-sm">+{{ $skill->users->count() - 3 }} more</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="/skills/{{ $skill->id }}" class="btn btn-sm btn-info">👁️ View Details</a>
                            @auth
                                @if(auth()->user()->role === 'teacher' || auth()->user()->role === 'student')
                                    <a href="/sessions" class="btn btn-sm btn-primary">📅 Book Session</a>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($skills->isEmpty())
            <div class="text-center py-16">
                <p class="text-5xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No skills available in this category yet.</p>
                <p class="text-gray-400 text-sm mt-2">Check back later or explore other categories!</p>
                <a href="/categories" class="btn btn-primary mt-4">Browse All Categories</a>
            </div>
        @endif
    </div>
@endsection