@extends('layouts.main')

@section('title')
    Оставить отзыв
@endsection

@section('content')
    <div class="container section">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="section-header">
                    <div class="section-label">Reviews</div>
                    <h2 class="section-title">Оставь отзыв</h2>
                    <div class="section-divider" aria-hidden="true"></div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 col-xl-4 mt-3_ mx-auto">

                <!-- Блок для вывода сообщения об успехе -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('review.store') }}" class="contact-form" aria-label="Contact form" >
                    @csrf
                    @php
                        $formFields = ['name', 'course', 'message'];

                        foreach ($formFields as $field):
                    @endphp
                    <div class="form-group">
                        <label for="{{ $field }}">{{ $field }}</label>
                        @php if ($field !== 'message'): @endphp
                        <input class="@error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" value="{{ old($field) }}"/>
                        @php else: @endphp
                        <textarea class="@error($field) is-invalid @enderror" id="{{ $field }}" name="{{ $field }}" rows="10" cols="10">{{ old($field) }}</textarea>
                        @php endif; @endphp
                        @error($field)
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @php endforeach; @endphp

                    <div class="col-12 px-1 d-flex justify-content-end">
                        <button class="btn btn--secondary btn-s" id="loadMoreVacancies" data-offset="6">
                            <span class="btn__content">Отправить</span>
                            <span class="btn__glitch"></span>
                            <span class="btn__label">xv-003</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
