@extends('layouts.main')

@section('title', 'Register - Eraaz Marketplace')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card-custom p-4">
                <div class="text-center mb-4">
                    <h3 class="fw-bold"><i class="bi bi-shop" style="color: var(--primary);"></i> Create Account</h3>
                    <p class="text-muted">Join the marketplace today</p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-custom mb-3">
                        @foreach ($errors->all() as $error)
                            <div><i class="bi bi-exclamation-circle me-1"></i> {{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" id="register-form">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary-custom w-100 py-2" id="register-btn">
                        <i class="bi bi-person-plus me-2"></i>Create Account
                    </button>

                    <div class="text-center mt-3">
                        <span class="text-muted small">Already have an account?</span>
                        <a href="{{ route('login') }}" class="small text-decoration-none fw-bold" style="color: var(--primary);"> Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
