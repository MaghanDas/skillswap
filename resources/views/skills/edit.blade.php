@extends('layouts.app')

@section('title', 'Edit Skill')

@section('content')
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✨ Edit Skill</h1>
            <p class="text-blue-100 mt-2">Update your skill details and information</p>
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

                    <form method="POST" action="{{ url('/skills/' . $skill->id) }}" enctype="multipart/form-data" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Skill Name</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name', $skill->name) }}" placeholder="e.g., Guitar, Web Development, Photography" class="input input-bordered input-lg" required />
                            @error('name')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Description</span>
                            </label>
                            <textarea name="description" placeholder="Describe what you can teach about this skill..." class="textarea textarea-bordered textarea-lg h-32" required>{{ old('description', $skill->description) }}</textarea>
                            @error('description')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">Category</span>
                                </label>
                                <select name="category_id" class="select select-bordered select-lg" required>
                                    <option disabled {{ old('category_id', $skill->category_id) ? '' : 'selected' }}>Select category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $skill->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>

                            <div class="form-control">
                                <label class="label">
                                    <span class="label-text font-bold text-lg">Difficulty Level</span>
                                </label>
                                <select name="difficulty" class="select select-bordered select-lg" required>
                                    <option value="beginner" {{ old('difficulty', $skill->difficulty) == 'beginner' ? 'selected' : '' }}>🟢 Beginner</option>
                                    <option value="intermediate" {{ old('difficulty', $skill->difficulty) == 'intermediate' ? 'selected' : '' }}>🟡 Intermediate</option>
                                    <option value="advanced" {{ old('difficulty', $skill->difficulty) == 'advanced' ? 'selected' : '' }}>🔴 Advanced</option>
                                </select>
                                @error('difficulty')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                            </div>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">📷 Skill Image</span>
                            </label>
                            @if($skill->image)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Current image:</p>
                                    <img src="{{ asset($skill->image) }}" alt="{{ $skill->name }}" class="h-40 w-40 object-cover rounded-lg border border-gray-200" />
                                </div>
                            @endif
                            <input type="file" name="image" class="file-input file-input-bordered file-input-lg w-full" accept="image/*" />
                            @error('image')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Skill</button>
                            <a href="/skills" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
