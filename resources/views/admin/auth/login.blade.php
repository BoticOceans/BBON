@extends('admin.layout')

@section('title', 'Login')
@section('body_class', 'admin-auth-page')

@section('content')
    <div class="auth-copy">
        <span class="eyebrow">B.BON Back Office</span>
        <h1>Manage the sportswear catalogue.</h1>
        <p>
            Add categories, update product images and keep every custom sportswear detail ready for the website.
        </p>
        <div class="auth-points">
            <span>Products</span>
            <span>Categories</span>
            <span>Catalogue</span>
        </div>
    </div>

    <div class="auth-card">
        <div class="login-mark">
            <span>B</span>
            <strong>B.BON Admin</strong>
        </div>
        <h2>Admin Login</h2>
        <p class="sub">Use your registered admin email and password.</p>

        @if (session('status'))
            <div class="alert alert-ok" style="margin-top: 18px;">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="alert alert-error" style="margin-top: 18px;">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf
            <div class="field">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="bbonsportswear@gmail.com" autofocus required>
            </div>
            <div class="field">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" required>
            </div>
            <button class="btn btn-red auth-submit" type="submit">Login</button>
        </form>
    </div>
@endsection
