<div class="container">
    <h1>btn login tg</h1>
    <p>{{ route('telegram-auth.auth')  }}</p>
</div>

<script async src="https://telegram.org/js/telegram-widget.js?22"
        data-telegram-login="{{ config('services.telegram.bot_username') }}"
        data-size="large"
        data-userpic="true"
        data-radius="10"
        data-auth-url="{{ route('telegram-auth.auth') }}"
        data-request-access="write">
</script>
