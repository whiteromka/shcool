@extends('layouts.main')

@section('content')


<div class="container mt-5" style="max-width: 400px">
    <h3>Login</h3>

    <form method="POST" action="{{ url('/login') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Email</label>
            <input class="form-control" name="email" type="email" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <input class="form-control" name="password" type="password" required>
        </div>

        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
@endsection
