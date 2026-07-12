@extends('layouts.app')

@section('title', 'SkillSwap - My Skills')

@section('content')
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div>
                <h1 class="text-4xl font-bold">🎯 My Skills</h1>
                <p class="text-purple-100 mt-2">Manage your teaching and learning skills</p>
            </div>
            <a href="/dashboard" class="btn btn-outline btn-lg text-white border-white hover:bg-white hover:text-purple-600">Back to Dashboard</a>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <!-- Add New Skills Section -->
        <div class="card bg-base-100 shadow-xl border border-gray-200 mb-8">
            <div class="card-body">
                <h2 class="card-title text-xl">➕ Add Skills</h2>

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
                    @endif

                <form method="POST" action="/user-skills" class="space-y-6">
                    @csrf

                    <div class="form-control">
                        <label class="label">
                            <span class="label-text font-bold text-lg">🎯 Select Skills to Add</span>
                        </label>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($allSkills as $skill)
                                @php
                                    $hasSkill = $userSkills->contains('skill_id', $skill->id);
                                @endphp
                                @if(!$hasSkill)
                                    <div class="form-control">
                                        <label class="label cursor-pointer justify-start gap-3 p-3 border border-gray-200 rounded-lg hover:bg-gray-50">
                                            <input type="checkbox" name="skills[]" value="{{ $skill->id }}" class="checkbox checkbox-primary checkbox-lg" />
                                            <div>
                                                <span class="label-text text-base font-semibold">{{ $skill->name }}</span>
                                                <p class="text-sm text-gray-600">{{ $skill->description }}</p>
                                                <div class="badge badge-info badge-sm mt-1">{{ $skill->category->name }}</div>
                                            </div>
                                        </label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        @error('skills')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                    </div>

                    <div class="form-control">
                        <label class="label cursor-pointer justify-start gap-3">
                            <input type="checkbox" name="is_teaching" value="1" class="checkbox checkbox-lg checkbox-primary" />
                            <span class="label-text font-bold text-lg">👨‍🏫 I want to teach these skills</span>
                        </label>
                        <p class="text-sm text-gray-500 mt-2">Check this if you want to offer these skills as a teacher. Leave unchecked if you want to learn them.</p>
                    </div>

                    <div class="form-control">
                        <button type="submit" class="btn btn-primary btn-lg font-bold">➕ Add Selected Skills</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- My Current Skills -->
        @if($userSkills->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Teaching Skills -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-xl text-green-600">👨‍🏫 Teaching Skills ({{ $userSkills->where('is_teaching', true)->count() }})</h2>
                        @if($userSkills->where('is_teaching', true)->count() > 0)
                            <div class="space-y-4">
                                @foreach($userSkills->where('is_teaching', true) as $userSkill)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-bold text-lg">{{ $userSkill->skill->name }}</h3>
                                            <div class="flex gap-2">
                                                @if($userSkill->experience_level === 'beginner')
                                                    <span class="badge badge-ghost">🟢 Beginner</span>
                                                @elseif($userSkill->experience_level === 'intermediate')
                                                    <span class="badge badge-ghost">🟡 Intermediate</span>
                                                @else
                                                    <span class="badge badge-ghost">🔴 Advanced</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-3">{{ $userSkill->skill->description }}</p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm">{{ $userSkill->skill->category->name }}</div>
                                        </div>
                                        <div class="mt-3 flex gap-2">
                                            <a href="/skills/{{ $userSkill->skill->id }}" class="btn btn-sm btn-info">View Skill</a>
                                            <form action="/user-skills/{{ $userSkill->id }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_teaching" value="0">
                                                <button type="submit" class="btn btn-sm btn-warning">Switch to Learning</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-6">No teaching skills yet. Add some skills above and check "I want to teach"!</p>
                        @endif
                    </div>
                </div>

                <!-- Learning Skills -->
                <div class="card bg-base-100 shadow-xl border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-xl text-blue-600">📚 Learning Skills ({{ $userSkills->where('is_teaching', false)->count() }})</h2>
                        @if($userSkills->where('is_teaching', false)->count() > 0)
                            <div class="space-y-4">
                                @foreach($userSkills->where('is_teaching', false) as $userSkill)
                                    <div class="border border-gray-200 rounded-lg p-4 hover:bg-gray-50">
                                        <div class="flex justify-between items-start mb-2">
                                            <h3 class="font-bold text-lg">{{ $userSkill->skill->name }}</h3>
                                            <div class="flex gap-2">
                                                @if($userSkill->experience_level === 'beginner')
                                                    <span class="badge badge-ghost">🟢 Beginner</span>
                                                @elseif($userSkill->experience_level === 'intermediate')
                                                    <span class="badge badge-ghost">🟡 Intermediate</span>
                                                @else
                                                    <span class="badge badge-ghost">🔴 Advanced</span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="text-gray-600 mb-3">{{ $userSkill->skill->description }}</p>
                                        <div class="flex gap-2">
                                            <div class="badge badge-primary badge-sm">{{ $userSkill->skill->category->name }}</div>
                                        </div>
                                        <div class="mt-3 flex gap-2">
                                            <a href="/skills/{{ $userSkill->skill->id }}" class="btn btn-sm btn-info">View Skill</a>
                                            <form action="/user-skills/{{ $userSkill->id }}" method="POST" class="inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="is_teaching" value="1">
                                                <button type="submit" class="btn btn-sm btn-success">Switch to Teaching</button>
                                            </form>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500 text-center py-6">No learning skills yet. Add some skills above without checking "I want to teach"!</p>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div class="card bg-base-100 shadow-xl border border-gray-200 text-center">
                <div class="card-body py-12">
                    <p class="text-6xl mb-4">🎯</p>
                    <p class="text-gray-600 text-lg font-semibold">No skills added yet</p>
                    <p class="text-gray-500">Add your first skills using the form above!</p>
                </div>
            </div>
        @endif
    </div>
@endsection