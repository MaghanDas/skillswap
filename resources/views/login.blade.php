@extends('layouts.app')

@section('title', 'SkillSwap - Login')

@section('content')
    <main class="flex items-center justify-center min-h-screen bg-base-200 py-12 px-4 sm:px-6 lg:px-8">
        <div class="card w-full max-w-md bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title text-3xl font-bold text-center mb-6">Login</h2>

                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        <span>{{ session('status') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-error mb-4">
                        <div>
                            @foreach ($errors->all() as $error)
                                <div>{{ $error }}</div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-control">
                        <label class="label"><span class="label-text">Email</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="email@example.com" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-4">
                        <label class="label"><span class="label-text">Password</span></label>
                        <input type="password" name="password" placeholder="Password" class="input input-bordered" required />
                    </div>
                    <div class="form-control mt-8">
                        <button type="submit" class="btn btn-primary w-full">Login</button>
                    </div>
                </form>
                <div class="mt-4 text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="link link-primary">Register here</a></p>
                </div>
            </div>
        </div>
    </main>
@endsection