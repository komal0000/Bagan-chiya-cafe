<header class="navbar" id="navbar">
    <div class="navbar-container">
        <a href="{{ route('home') }}" class="navbar-logo">
            <div class="logo-container">
                <div class="logo-icon">
                    <img src="https://res.cloudinary.com/dzdinuw5d/image/upload/v1754205687/Erasedlogo_u4qem7.png"
                        alt="Logo" style="height: 50px;">
                    <div class="steam">☁️</div>
                </div>

                <div class="logo-text">
                    <span class="logo-main">Bagan</span>
                    <span class="logo-script">Chiya Cafe</span>
                </div>
            </div>
        </a>

        {{-- Desktop Navbar Links --}}
        <nav class="navbar-links">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">
                <i class="fas fa-leaf"></i>
                <span>Menu</span>
            </a>
            <a href="{{ route('story') }}" class="{{ request()->routeIs('story') ? 'active' : '' }}">
                <i class="fas fa-mountain"></i>
                <span>Our Story</span>
            </a>
            <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                <i class="fas fa-camera"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ route('visitus') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Visit Us</span>
            </a>
        </nav>

        {{-- Order Button --}}
        {{-- <div class="navbar-actions">
            <a href="{{ route('menu') }}" class="btn-order">
                <i class="fas fa-shopping-cart"></i>
                <span>Order Now</span>
            </a>
        </div> --}}

        {{-- Mobile Toggle --}}
        <button class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </button>

        {{-- Mobile Menu --}}
        <div class="mobile-menu" id="mobileMenu">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('menu') }}" class="{{ request()->routeIs('menu') ? 'active' : '' }}">
                <i class="fas fa-leaf"></i>
                <span>Menu</span>
            </a>
            <a href="{{ route('story') }}" class="{{ request()->routeIs('story') ? 'active' : '' }}">
                <i class="fas fa-mountain"></i>
                <span>Our Story</span>
            </a>
            <a href="{{ route('gallery') }}" class="{{ request()->routeIs('gallery') ? 'active' : '' }}">
                <i class="fas fa-camera"></i>
                <span>Gallery</span>
            </a>
            <a href="{{ route('visitus') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Visit Us</span>
            </a>
        </div>
    </div>
</header>
