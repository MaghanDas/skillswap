@extends('layouts.app')

@section('title', 'SkillSwap - Skills')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">📚 Available Skills</h1>
                    <p class="text-blue-100">Discover and learn from community experts</p>
                </div>
                <a href="/skills/create" class="btn btn-warning btn-lg font-bold">+ Add Skill</a>
            </div>
        </div>
    </div>

    <!-- Skills Grid -->
    <div class="container mx-auto px-6 pb-12">
        <!-- Search Bar -->
        <div class="mb-8">
            <form method="GET" action="/skills" class="flex gap-2">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search skills..." class="input input-bordered input-lg flex-1" />
                <button type="submit" class="btn btn-primary btn-lg font-bold">Search</button>
                @if(request('search'))
                    <a href="/skills" class="btn btn-ghost btn-lg">Clear</a>
                @endif
            </form>
            @if(request('search'))
                <p class="text-sm text-gray-600 mt-2">Showing results for: <strong>{{ request('search') }}</strong></p>
            @endif
        </div>

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
                        
                        <div class="card-actions justify-end mt-4 gap-2">
                            <a href="/skills/{{ $skill->id }}" class="btn btn-sm btn-info">👁️ View</a>
                            <a href="/skills/{{ $skill->id }}/edit" class="btn btn-sm btn-primary">✏️ Edit</a>
                            <form action="/skills/{{ $skill->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        @if($skills->isEmpty())
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No skills yet. Create one to get started!</p>
                <a href="/skills/create" class="btn btn-primary mt-4">Create First Skill</a>
            </div>
        @endif
    </div>
@endsection