@extends('layouts.app')

@section('title', 'Edit User Skill')

@section('content')
    <div class="bg-gradient-to-r from-indigo-600 to-blue-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✏️ Edit User Skill</h1>
            <p class="text-indigo-100 mt-2">Update user skill assignment and expertise</p>
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

                    <form method="POST" action="{{ url('/user-skills/' . $userSkill->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">👤 User</span>
                            </label>
                            <select name="user_id" class="select select-bordered select-lg" required>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ $user->id == $userSkill->user_id ? 'selected' : '' }}>
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">🎯 Skill</span>
                            </label>
                            <div class="p-4 bg-gray-100 rounded-lg border border-gray-300">
                                <p class="text-lg font-bold">{{ $userSkill->skill->name }}</p>
                                <p class="text-sm text-gray-600">(Read-only field)</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📊 Experience Level</span>
                                </label>
                                <select name="experience_level" class="select select-bordered select-lg" required>
                                    <option value="beginner" {{ $userSkill->experience_level == 'beginner' ? 'selected' : '' }}>🟢 Beginner</option>
                                    <option value="intermediate" {{ $userSkill->experience_level == 'intermediate' ? 'selected' : '' }}>🟡 Intermediate</option>
                                    <option value="advanced" {{ $userSkill->experience_level == 'advanced' ? 'selected' : '' }}>🔴 Advanced</option>
                                </select>
                                @error('experience_level')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control flex flex-col justify-end">
                                <label class="label cursor-pointer justify-start gap-3">
                                    <input type="checkbox" name="is_teaching" value="1" class="checkbox checkbox-lg checkbox-primary" {{ $userSkill->is_teaching ? 'checked' : '' }} />
                                    <span class="label-text font-bold text-lg">👨‍🏫 Teaching</span>
                                </label>
                                <p class="text-sm text-gray-500">This user is teaching skill?</p>
                            </div>
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Skill</button>
                            <a href="/user-skills" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection