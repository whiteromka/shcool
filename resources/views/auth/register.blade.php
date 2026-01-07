@extends('layouts.main')

@section('content')
<div class="container mt-5" style="max-width: 400px">
    <h3>Register</h3>

    {{-- Ошибки валидации --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="mb-3">
            <input class="form-control @error('name') is-invalid @enderror" 
                   name="name" 
                   placeholder="Name" 
                   value="{{ old('name') }}" 
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="form-control @error('email') is-invalid @enderror" 
                   name="email" 
                   placeholder="Email" 
                   value="{{ old('email') }}" 
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="form-control @error('password') is-invalid @enderror" 
                   name="password" 
                   type="password" 
                   placeholder="Password" 
                   required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <input class="form-control @error('password_confirmation') is-invalid @enderror" 
                   name="password_confirmation" 
                   type="password" 
                   placeholder="Confirm password" 
                   required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-success w-100">Register</button>
    </form>
</div>
@endsection
