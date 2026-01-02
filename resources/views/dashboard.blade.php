@extends('layouts.main')

@section('content')
<div class="container mt-5">
    <h2>Dashboard</h2>

    <p>Привет, {{ auth()->user()->name }}</p>

    <form method="POST" action="/logout">
        @csrf
        <button class="btn btn-danger">Logout</button>
    </form>
</div>
@endsection
