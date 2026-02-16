<div class="" style="">
<div class="container">
    <h2 class="h2-common">
        {{--        <span>0.01</span> <br>--}}
        НАШИ КУРСЫ И МОДУЛИ
    </h2>
</div>

<div class="container-fluid top-ark bg-purple px-0">
    <div class="streaks">
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <span> [][][]== ===</span>
    </div>
</div>

<div class="container-fluid px-0 bg-purple">
    <br>
    <div class="container cy-items-container">
        <div class="row">
            <?php $courses = [
                ['name' => 'Front', 'label' => 'JS', 'css' => 'bg-JS', 'crew' => 14],
                ['name' => 'Back', 'label' => 'PHP', 'css' => 'bg-PHP', 'crew' => 17],
                ['name' => 'Gamedev', 'label' => 'C#', 'css' => 'bg-DEFAULT', 'crew' => 2],
                ['name' => 'Foreign Lang', 'label' => 'En', 'css' => 'bg-DEFAULT', 'crew' => 25],
            ]?>

            @foreach($courses as $k => $course)
                <div class="col-12 col-sm-6 col-lg-3 mb-20">
                    <div class="pipki">
                        @for($i = 1; $i <= $course['crew']; $i++)
                            <div class="pipka"></div>
                        @endfor
                    </div>
                    <div class="cy-item js-cy-brackets" data-color="orange" data-width="2" data-size="10">
                        <div class="cy-item-head">
                            <div class="cy-item-head-left {{ $course['css'] }}">
                                <span> {{ $course['label'] }}</span>
                            </div>
                            <div class="cy-item-head-right">
                                <span>{{ $course['name'] }}</span>
                            </div>
                        </div>
                        <div class="cy-item-body">
                            @if($k !== 20)
                                <div class="badge-cell">
                                    <div class="status-badge">
                                        <div class="status-badge__hex glow-cyan">
                                            <span class="status-badge__status">ACTIVE</span>
                                            <span class="status-badge__value">2.99</span>
                                        </div>
                                        <div class="badge-dots">
                                            <div class="badge-dot badge-dot--cyan"></div>
                                            <div class="badge-dot badge-dot--orange"></div>
                                            <div class="badge-dot badge-dot--cyan"></div>
                                            <div class="badge-dot badge-dot--orange"></div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <x-test.dino-game></x-test.dino-game>
                            @endif
                            <br>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aliquid nobis quas quos!
                                Maxime nemo!</p>
                        </div>
                    </div>

                    <div class="item-btn-wrapper">
                        <div class="item-btn js-cyber-text-animation">
                            <span>Подробнее</span>
                        </div>
                        <div class="item-btn-strokes">
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>
    </div>
    <br>
    <br>
</div>
</div>
<div class="container-fluid bottom-ark bg-purple px-0">
    <div class="streaks">
        <span>== ===[][] == ==[] === [][][]</span>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
        <div class="streak-left streak-b"></div>
    </div>
</div>
<br>
<br>
<br>

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cyItems = document.querySelectorAll('.cy-item');

            cyItems.forEach(item => {
                let headTimeout, bracketTimeout, blinkInterval, spanTimeout;

                item.addEventListener('mouseenter', () => {
                    const headRight = item.querySelector('.cy-item-head-right');
                    const headSpan = headRight.querySelector('span');

                    // Мерцание перед окончательным добавлением .bs-blue
                    headTimeout = setTimeout(() => {
                        let count = 0;
                        blinkInterval = setInterval(() => {
                            headRight.classList.toggle('bs-blue');
                            count++;
                            if (count >= 6) {
                                clearInterval(blinkInterval);
                                headRight.classList.add('bs-blue');

                                // Через 0.1s добавляем класс span
                                spanTimeout = setTimeout(() => {
                                    if (headSpan) headSpan.classList.add('cy-item-head-right-hovered');
                                }, 100);
                            }
                        }, 100);
                    }, 400);

                    // Динамические элементы
                    const brackets = item.querySelectorAll('.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br');
                    brackets.forEach(b => b.style.backgroundColor = 'transparent');
                    bracketTimeout = setTimeout(() => {
                        brackets.forEach(b => b.style.backgroundColor = 'orange');
                    }, 100);

                    // Искусственный hover на кнопке
                    const btnWrapper = item.parentElement.querySelector('.item-btn-wrapper');
                    if (btnWrapper) {
                        const cyberText = btnWrapper.querySelector('.js-cyber-text-animation');
                        if (cyberText) {
                            // Создаем событие mouseenter
                            const enterEvent = new MouseEvent('mouseenter', { bubbles: true });
                            cyberText.dispatchEvent(enterEvent);
                        }
                    }
                });

                item.addEventListener('mouseleave', () => {
                    const headRight = item.querySelector('.cy-item-head-right');
                    const headSpan = headRight.querySelector('span');

                    clearTimeout(headTimeout);
                    clearTimeout(bracketTimeout);
                    clearTimeout(spanTimeout);
                    clearInterval(blinkInterval);

                    // Снимаем классы
                    headRight.classList.remove('bs-blue');
                    if (headSpan) headSpan.classList.remove('cy-item-head-right-hovered');

                    const brackets = item.querySelectorAll('.cy-brackets-tl, .cy-brackets-tr, .cy-brackets-bl, .cy-brackets-br');
                    brackets.forEach(b => b.style.backgroundColor = 'transparent');

                    // Искусственный уход мыши с кнопки
                    const btnWrapper = item.parentElement.querySelector('.item-btn-wrapper');
                    if (btnWrapper) {
                        const cyberText = btnWrapper.querySelector('.js-cyber-text-animation');
                        if (cyberText) {
                            const leaveEvent = new MouseEvent('mouseleave', { bubbles: true });
                            cyberText.dispatchEvent(leaveEvent);
                        }
                    }
                });
            });
        });

    </script>
@endpush

