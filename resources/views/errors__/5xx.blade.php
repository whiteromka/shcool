@extends('layouts.main')
@section('title')
    Ошибка
@endsection

@section('content')
    <div style="color: white">
        <div class="error-code">{{ $exception->getStatusCode() }}</div>
        <div class="error-title" >
            {{ 'Произошла ошибка' }}
        </div>

        <div class="error-message">
            @if($exception->getMessage() && !in_array($exception->getStatusCode(), [500, 599]))
                {{ $exception->getMessage() }}
            @endif
        </div>

        <div class="buttons">
            <button onclick="window.history.back()" class="btn btn-back">
                ← Вернуться назад
            </button>
            <a href="{{ url('/') }}" class="btn btn-home">
                На главную
            </a>
        </div>
    </div>
@endsection
