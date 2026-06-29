@extends('admin.layout')

@section('title', 'Login')

@section('content')
    <div class="page-head">
        <div>
            <h1>Admin Login</h1>
            <p class="sub">Enter the admin password to manage product categories and products.</p>
        </div>
    </div>

    <form class="panel panel-pad" method="POST" action="{{ route('admin.login.store') }}" style="max-width: 460px;">
        @csrf
        <div class="field">
            <label for="password">Password</label>
            <input id="password" type="password" name="password" autofocus required>
        </div>
        <button class="btn btn-red" type="submit">Login</button>
    </form>
@endsection
