@extends('layouts.app')

@section('title', 'Schedule Session')

@section('content')
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">📅 Schedule New Session</h1>
            <p class="text-purple-100 mt-2">Create a skill exchange session with a teacher or student</p>
        </div>
    </div>

    <div class="container mx-auto px-6 pb-12">
        <div class="max-w-3xl mx-auto">
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

                    <form method="POST" action="/sessions" class="space-y-6">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Session Title</span>
                            </label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="e.g., Learn Guitar Basics" class="input input-bordered input-lg" required />
                            @error('title')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Description</span>
                            </label>
                            <textarea name="description" placeholder="Describe what will be covered in this session..." class="textarea textarea-bordered textarea-lg h-24" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="alert alert-info">
                            <span>Students will book this session separately from their own portal.</span>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">🎯 Skill</span>
                            </label>
                            <select name="skill_id" class="select select-bordered select-lg" required>
                                <option disabled {{ old('skill_id') ? '' : 'selected' }}>Select skill</option>
                                @foreach($skills as $skill)
                                    <option value="{{ $skill->id }}" {{ old('skill_id') == $skill->id ? 'selected' : '' }}>{{ $skill->name }}</option>
                                @endforeach
                            </select>
                            @error('skill_id')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📅 Date</span>
                                </label>
                                <input type="date" name="session_date" value="{{ old('session_date') }}" class="input input-bordered input-lg" required />
                                @error('session_date')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">⏰ Time</span>
                                </label>
                                <input type="time" name="session_time" value="{{ old('session_time') }}" class="input input-bordered input-lg" required />
                                @error('session_time')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">⏱️ Duration (min)</span>
                                </label>
                                <input type="number" name="duration" value="{{ old('duration') }}" min="1" placeholder="60" class="input input-bordered input-lg" required />
                                @error('duration')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">📍 Location</span>
                                </label>
                                <input type="text" name="location" value="{{ old('location') }}" placeholder="e.g., Coffee Shop, Online" class="input input-bordered input-lg" required />
                                @error('location')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">✅ Status</span>
                                </label>
                                <select name="status" class="select select-bordered select-lg">
                                    <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>✅ Confirmed</option>
                                    <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>🎉 Completed</option>
                                    <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>❌ Cancelled</option>
                                </select>
                                @error('status')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">📅 Create Session</button>
                            <a href="/sessions" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection