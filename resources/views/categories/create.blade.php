@extends('layouts.app')

@section('title', 'Create Category')

@section('content')
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-4xl font-bold">Create New Category</h1>
                    <p class="text-green-100 mt-2">Add a new skill category to the platform</p>
                </div>
                <a href="/categories" class="btn btn-outline text-white border-white hover:bg-white hover:text-green-700">Back to Categories</a>
            </div>
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

                    <form method="POST" action="/categories" class="space-y-6">
                        @csrf

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Category Name</span>
                            </label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Music, Art, Programming" class="input input-bordered input-lg" required />
                            @error('name')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">Description</span>
                            </label>
                            <textarea name="description" placeholder="Describe what skills fall under this category..." class="textarea textarea-bordered textarea-lg h-32" required>{{ old('description') }}</textarea>
                            @error('description')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control mt-8 flex flex-col sm:flex-row gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">Create Category</button>
                            <a href="/categories" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection