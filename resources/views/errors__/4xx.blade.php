@extends('layouts.main')
@section('title')
    @php
        $titles = [
            400 => 'Неверный запрос',
            401 => 'Требуется авторизация',
            403 => 'Доступ запрещен',
            404 => 'Страница не найдена',
            419 => 'Сессия истекла',
            422 => 'Ошибка валидации',
            429 => 'Слишком много запросов',
        ];
        $title = $titles[$exception->getStatusCode()] ?? 'Ошибка';
    @endphp
    {{ $title }}
@endsection

@section('content')

    <div style="color: white">
        <div class="error-code">{{ $exception->getStatusCode() }}</div>
        <div class="error-title" >
            @php
                $titles = [
                    400 => 'Неверный запрос',
                    401 => 'Требуется авторизация',
                    403 => 'Доступ запрещен',
                    404 => 'Страница не найдена',
                    419 => 'Сессия истекла',
                    422 => 'Ошибка валидации',
                    429 => 'Слишком много запросов',
                ];
            @endphp
            {{ $titles[$exception->getStatusCode()] ?? 'Произошла ошибка' }}
        </div>

        <div class="error-message">
            @if($exception->getMessage() && !in_array($exception->getStatusCode(), [404, 419]))
                {{ $exception->getMessage() }}
            @else
                @switch($exception->getStatusCode())
                    @case(404)
                        Запрашиваемая страница не найдена.
                        @break
                    @case(419)
                        Время сессии истекло. Пожалуйста, обновите страницу.
                        @break
                    @default
                        Что-то пошло не так. Пожалуйста, попробуйте еще раз.
                @endswitch
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
