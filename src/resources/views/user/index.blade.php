@extends('layouts.main')

@section('title')
    О нас — Мой сайт
@endsection

@section('content')
    <h1>1111</h1>
    <div class="container mt-5">
        <h1 class="text-primary">Bootstrap 5 подключён ✔️</h1>

        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#testModal">
            Открыть модальное окно
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="testModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Модальное окно Bootstrap</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Всё работает 🚀
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                qqqq
            </div>
            <div class="col-sm-2 te">
                qqq
            </div>
            <div class="col-sm-12"></div>
            <p class="te"></p>

        </div>
    </div>
    <p class="text-danger"> !!!</p>
@endsection
