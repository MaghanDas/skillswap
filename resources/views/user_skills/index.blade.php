@extends('layouts.app')

@section('title', 'User Skills')

@section('content')
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold">🎯 User Skills</h1>
                <p class="text-indigo-100 mt-2">Manage user skills and expertise levels</p>
            </div>
            <a href="/user-skills/create" class="btn btn-lg btn-secondary gap-2">
                <span>➕</span>
                <span>Add User Skill</span>
            </a>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        @if(isset($userSkills) && count($userSkills) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($userSkills as $us)
                    <div class="card bg-base-100 shadow-xl border border-gray-200 hover:shadow-2xl transition-all">
                        <div class="card-body">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h2 class="text-xl font-bold">{{ $us->skill->name }}</h2>
                                    <p class="text-sm text-gray-600">by {{ $us->user->name }}</p>
                                </div>
                                @if($us->is_teaching)
                                    <span class="badge badge-info">👨‍🏫 Teaching</span>
                                @else
                                    <span class="badge badge-success">👨‍🎓 Learning</span>
                                @endif
                            </div>
                            
                            <div class="mb-4">
                                @if($us->experience_level === 'beginner')
                                    <span class="badge badge-lg badge-ghost">🟢 Beginner</span>
                                @elseif($us->experience_level === 'intermediate')
                                    <span class="badge badge-lg badge-ghost">🟡 Intermediate</span>
                                @else
                                    <span class="badge badge-lg badge-ghost">🔴 Advanced</span>
                                @endif
                            </div>

                            <div class="card-actions justify-between">
                                <a href="/user-skills/{{ $us->id }}/edit" class="btn btn-sm btn-warning">✏️ Edit</a>
                                <form action="/user-skills/{{ $us->id }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">🗑️ Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="card bg-base-100 shadow-xl border border-gray-200 text-center">
                <div class="card-body py-12">
                    <p class="text-5xl mb-4">🎯</p>
                    <p class="text-gray-600 text-lg font-semibold">No user skills yet</p>
                    <p class="text-gray-500 mb-6">Start by adding a skill assignment</p>
                    <a href="/user-skills/create" class="btn btn-primary btn-lg">➕ Add First Skill</a>
                </div>
            </div>
        @endif
    </div>
@endsection