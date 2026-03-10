<div>
    @if($isUserJoined)
        <div class="btn btn-s btn--success c-d">
            <span class="btn__content">Вы записаны</span>
            <span class="btn__glitch_"></span>
            <span class="btn__label_">r25</span>
        </div>

        <button
            wire:click="toggle"
            class="btn btn-s btn--secondary"
        >
            <span class="btn__content">Выписаться</span>
            <span class="btn__glitch"></span>
            <span class="btn__label">r25</span>
        </button>
    @else
        <div class="d-flex align-items-center justify-content-end">
            @guest
                <div class="sign-error">
                    <svg class="warning-icon" width="28" height="28" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12 2L1 21h22L12 2z" stroke="currentColor" stroke-width="2" fill="none"/>
                        <path d="M12 9v4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                        <circle cx="12" cy="17" r="1" fill="currentColor"/>
                    </svg>
                    <i>auth</i>
                </div>
            @endguest

            <button
                wire:click="toggle"
                class="btn btn-s"
            >
                <span class="btn__content">Записаться бесплатно</span>
                <span class="btn__glitch"></span>
                <span class="btn__label">r25</span>
            </button>
        </div>
    @endif
</div>
