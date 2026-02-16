{{-- ========= NAVIGATION ======== --}}
<div class="container-fluid px-0">
    <nav class="nexus-nav" role="navigation" aria-label="Main navigation">
        <div class="nav-logo">NEXUS</div>
        <ul class="nav-links">
            <li><a href=" {{ route('site.index') }}">Главная</a></li>
            <li><a href="{{ route('site.front') }}">Front</a></li>
            <li><a href="{{ route('site.back') }}">Back</a></li>
            <li><a href="{{ route('site.gamedev') }}">Gamedev</a></li>
            <li><a href="#">English</a></li>
        </ul>
        <div class="nav-status">
            <span class="dot" aria-hidden="true"></span>
            System Online
        </div>
    </nav>
</div>
