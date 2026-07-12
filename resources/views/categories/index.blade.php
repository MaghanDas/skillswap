@extends('layouts.app')

@section('title', 'SkillSwap - Categories')

@section('content')
    <!-- Header -->
    <div class="bg-gradient-to-r from-green-600 to-emerald-600 text-white py-12 mb-12">
        <div class="container mx-auto px-6">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-4xl font-bold mb-2">🏷️ Categories</h1>
                    <p class="text-green-100">Organize and manage skill categories</p>
                </div>
                <a href="{{ url('/categories/create') }}" class="btn btn-warning btn-lg font-bold">+ Add Category</a>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="container mx-auto px-6 pb-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categories as $category)
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-all border border-gray-200">
                    <div class="card-body">
                        <h2 class="card-title text-2xl mb-3">🎯 {{ $category->name }}</h2>
                        <p class="text-gray-600 mb-4">{{ $category->description }}</p>
                        
                        <div class="card-actions justify-end mt-6 gap-2">
                            <a href="/categories/{{ $category->id }}" class="btn btn-sm btn-info">👁️ View Skills</a>
                            <a href="/categories/{{ $category->id }}/edit" class="btn btn-sm btn-primary">Edit</a>
                            <form action="/categories/{{ $category->id }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($categories->isEmpty())
            <div class="text-center py-16">
                <p class="text-3xl text-gray-400 mb-4">📭</p>
                <p class="text-gray-500 text-lg">No categories yet. Create one to get started!</p>
                <a href="/categories/create" class="btn btn-primary mt-4">Create First Category</a>
            </div>
        @endif
    </div>
@endsection