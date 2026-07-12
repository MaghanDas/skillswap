@extends('layouts.app')

@section('title', 'SkillSwap - Register')

@section('content')
    <main class="flex items-center justify-center min-h-screen bg-base-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-3xl font-bold text-center mb-6">Create Account</h2>

                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text">Name</span></label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Your Name" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text">Password</span></label>
                        <input type="password" name="password" placeholder="Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text">Confirm Password</span></label>
                        <input type="password" name="password_confirmation" placeholder="Confirm Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-6">
                        <label class="label"><span class="label-text">I want to join as:</span></label>
                        <div class="flex items-center gap-4">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="role" class="radio radio-primary" value="student" {{ old('role', 'student') === 'student' ? 'checked' : '' }} required />
                                <span class="label-text">Student</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="radio" name="role" class="radio radio-secondary" value="teacher" {{ old('role') === 'teacher' ? 'checked' : '' }} required />
                                <span class="label-text">Teacher</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary w-full">Register</button>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    <p>Already have an account? <a href="{{ route('login') }}" class="link link-primary">Login here</a></p>
                </div>
            </div>
        </div>
    </main>
@endsection