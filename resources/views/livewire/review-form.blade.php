<div class="review-form-container">
    <div id="review-success-alert" class="alert alert-success alert-dismissible fade show" role="alert" style="display: none;">
        Отзыв успешно добавлен.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <form id="review-form" class="contact-form" method="POST">
        @csrf

        <div class="form-group">
            <label for="modules_id">Module</label>
            <select id="modules_id" name="modules_id" class="form-control">
                <option value="">Модуль</option>
                @foreach($activeModules as $id => $name)
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
            <div class="invalid-feedback" id="error-modules_id"></div>
        </div>

        <div class="form-group">
            <label for="stars">Stars</label>
            <select id="stars" name="stars" class="form-control">
                <option value="">Оценка</option>
                @for($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            <div class="invalid-feedback" id="error-stars"></div>
        </div>

        <div class="form-group">
            <label for="message">Message</label>
            <textarea id="message" name="message" class="form-control" rows="5"></textarea>
            <div class="invalid-feedback" id="error-message"></div>
        </div>

        <div class="invalid-feedback" id="error-auth" style="display: block; margin-bottom: 10px;"></div>

        <div class="d-flex align-items-center justify-content-end">
            @guest
            <div class="sign-error js-cy-brackets" data-color="red" data-context="Требуется авторизация">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" width="22" height="22">
                    <path fill="red" d="M256 0c14.7 0 28.2 8.1 35.2 21l216 400c6.7 12.4 6.4 27.4-.8 39.5S486.1 480 472 480L40 480c-14.1 0-27.2-7.4-34.4-19.5s-7.5-27.1-.8-39.5l216-400c7-12.9 20.5-21 35.2-21zm0 352a32 32 0 1 0 0 64 32 32 0 1 0 0-64zm0-192c-18.2 0-32.7 15.5-31.4 33.7l7.4 104c.9 12.5 11.4 22.3 23.9 22.3 12.6 0 23-9.7 23.9-22.3l7.4-104c1.3-18.2-13.1-33.7-31.4-33.7z"></path>
                </svg>
                <i>auth</i>
            </div>
            <button type="submit" id="review-submit-btn" class="btn btn-s" disabled>
                <span class="btn__content">Отправить</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
            @endguest
            @auth
            <button type="submit" id="review-submit-btn" class="btn btn-s">
                <span class="btn__content">Отправить</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
            @endauth
        </div>
    </form>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('review-form');
    const submitBtn = document.getElementById('review-submit-btn');
    const btnContent = submitBtn.querySelector('.btn__content');
    const successAlert = document.getElementById('review-success-alert');

    // Элементы формы
    const modulesIdInput = document.getElementById('modules_id');
    const starsInput = document.getElementById('stars');
    const messageInput = document.getElementById('message');

    // Получаем CSRF токен из meta
    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    // Функция для отображения ошибок
    function showErrors(errors) {
        // Сброс всех ошибок
        clearErrors();

        // Ошибка авторизации
        if (errors.auth) {
            const authErrorEl = document.getElementById('error-auth');
            authErrorEl.textContent = errors.auth[0];
            authErrorEl.style.display = 'block';
        }

        // Ошибки полей
        if (errors.modules_id) {
            const el = document.getElementById('error-modules_id');
            el.textContent = errors.modules_id[0];
            el.style.display = 'block';
            modulesIdInput.classList.add('is-invalid');
        }

        if (errors.stars) {
            const el = document.getElementById('error-stars');
            el.textContent = errors.stars[0];
            el.style.display = 'block';
            starsInput.classList.add('is-invalid');
        }

        if (errors.message) {
            const el = document.getElementById('error-message');
            el.textContent = errors.message[0];
            el.style.display = 'block';
            messageInput.classList.add('is-invalid');
        }
    }

    // Функция для очистки ошибок
    function clearErrors() {
        ['modules_id', 'stars', 'message', 'auth'].forEach(field => {
            const el = document.getElementById('error-' + field);
            if (el) {
                el.textContent = '';
                el.style.display = 'none';
            }
        });

        [modulesIdInput, starsInput, messageInput].forEach(input => {
            input.classList.remove('is-invalid');
        });
    }

    // Обработчик отправки формы
    form.addEventListener('submit', async function(e) {
        e.preventDefault();

        // Блокировка кнопки отправки
        submitBtn.disabled = true;
        btnContent.textContent = 'Отправка...';

        // Очистка предыдущих ошибок
        clearErrors();
        successAlert.style.display = 'none';

        // Сбор данных формы
        const formData = new FormData();
        formData.append('modules_id', modulesIdInput.value || null);
        formData.append('stars', starsInput.value);
        formData.append('message', messageInput.value);

        try {
            const response = await fetch('{{ route("review.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                }
            });

            const data = await response.json();

            if (response.ok && data.success) {
                // Успешная отправка
                successAlert.style.display = 'block';
                form.reset();

                // Скрыть alert через 5 секунд
                setTimeout(() => {
                    successAlert.style.display = 'none';
                }, 5000);
            } else {
                // Ошибки валидации или другие ошибки
                if (data.errors) {
                    showErrors(data.errors);
                } else if (data.message) {
                    const authErrorEl = document.getElementById('error-auth');
                    authErrorEl.textContent = data.message;
                    authErrorEl.style.display = 'block';
                }
            }
        } catch (error) {
            console.error('Error submitting review:', error);
            const authErrorEl = document.getElementById('error-auth');
            authErrorEl.textContent = 'Произошла ошибка при отправке отзыва. Попробуйте позже.';
            authErrorEl.style.display = 'block';
        } finally {
            // Разблокировка кнопки
            submitBtn.disabled = false;
            btnContent.textContent = 'Отправить';
        }
    });

    // Очистка ошибок при вводе
    [modulesIdInput, starsInput, messageInput].forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            const errorEl = document.getElementById('error-' + this.id);
            if (errorEl) {
                errorEl.style.display = 'none';
            }
        });
    });
});
</script>
@endpush
