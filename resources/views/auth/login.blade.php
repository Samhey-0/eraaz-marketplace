@extends('layouts.main')

@section('title', 'Login - Eraaz Marketplace')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-custom p-4">
                <div class="text-center mb-4">
                    <img src="{{ asset('images/logo.png') }}" alt="Eraaz Logo" class="mb-3" style="height: 80px; border-radius: 15px; box-shadow: var(--shadow-lg);">
                    <h3 class="fw-bold">Welcome Back</h3>
                    <p class="text-muted">Sign in to your <span class="fw-bold" style="color: var(--primary);">Eraaz</span> account</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-custom mb-3">
                        @foreach ($errors->all() as $error)
                            <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" id="login-form">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label small" for="remember">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="small text-decoration-none" style="color: var(--primary);">Forgot password?</a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-2" id="login-btn">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Sign In
                    </button>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Don't have an account?</span>
                        <a href="{{ route('register') }}" class="small text-decoration-none fw-bold" style="color: var(--primary);"> Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
