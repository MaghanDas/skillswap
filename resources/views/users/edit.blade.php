@extends('layouts.app')

@section('title', 'Edit User')

@section('content')
    <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white py-12 mb-8">
        <div class="container mx-auto px-6">
            <h1 class="text-4xl font-bold">✏️ Edit User Role</h1>
            <p class="text-red-100 mt-2">Update user permissions and role assignment</p>
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

                    <form method="POST" action="/users/{{ $user->id }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">👤 Name</span>
                            </label>
                            <input type="text" value="{{ $user->name }}" disabled class="input input-bordered input-lg bg-gray-100" />
                            <p class="text-sm text-gray-500 mt-2">(Read-only field)</p>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">📧 Email</span>
                            </label>
                            <input type="text" value="{{ $user->email }}" disabled class="input input-bordered input-lg bg-gray-100" />
                            <p class="text-sm text-gray-500 mt-2">(Read-only field)</p>
                        </div>

                        <div class="form-control">
                            <label class="label">
                                <span class="label-text font-bold text-lg">🎯 User Role</span>
                            </label>
                            <select name="role" class="select select-bordered select-lg" required>
                                <option value="student" {{ $user->role == 'student' ? 'selected' : '' }}>👨‍🎓 Student</option>
                                <option value="teacher" {{ $user->role == 'teacher' ? 'selected' : '' }}>👨‍🏫 Teacher</option>
                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>🔐 Admin</option>
                            </select>
                            <p class="text-sm text-gray-500 mt-2">Select the role to assign to this user</p>
                            @error('role')<p class="text-error text-sm mt-2">{{ $message }}</p>@enderror
                        </div>

                        <div class="form-control mt-8 flex gap-3">
                            <button type="submit" class="btn btn-primary btn-lg font-bold">💾 Update Role</button>
                            <a href="/users" class="btn btn-outline btn-lg">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection