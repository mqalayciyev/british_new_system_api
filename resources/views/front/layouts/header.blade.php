<header class="ud-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">

                    <a class="navbar-brand" href="{{ route('home') }}">
                        <img src="{{ asset('src/images/logo/logo.svg') }}" alt="Logo" />
                    </a>

                    <button class="navbar-toggler">
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                    </button>

                    <div class="navbar-collapse">
                        {{-- <ul id="nav" class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#home">Home</a>
                            </li>

                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#about">About</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#pricing">Pricing</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#team">Team</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll" href="#contact">Contact</a>
                            </li>
                            <li class="nav-item nav-item-has-children">
                                <a href="javascript:void(0)"> Pages </a>
                                <ul class="ud-submenu">
                                    <li class="ud-submenu-item">
                                        <a href="about.html" class="ud-submenu-link">
                                            About Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="pricing.html" class="ud-submenu-link">
                                            Pricing Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="contact.html" class="ud-submenu-link">
                                            Contact Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="blog.html" class="ud-submenu-link">
                                            Blog Grid Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="blog-details.html" class="ud-submenu-link">
                                            Blog Details Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="login.html" class="ud-submenu-link">
                                            Sign In Page
                                        </a>
                                    </li>
                                    <li class="ud-submenu-item">
                                        <a href="404.html" class="ud-submenu-link">404 Page</a>
                                    </li>
                                </ul>
                            </li>
                        </ul> --}}
                    </div>

                    <div class="navbar-btn d-none d-sm-inline-block">

                        @auth
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <a href="{{ route('account') }}" class="ud-main-btn ud-login-btn">
                                    {{ auth()->user()->name }}
                                </a>

                                <button type="submit" class="ud-main-btn ud-login-btn m-0">
                                    Çıxış
                                </button>
                            </form>

                        @endauth

                        @guest
                            <a href="{{ route('login') }}" class="ud-main-btn ud-login-btn">
                                Daxil ol
                            </a>

                            <a class="ud-main-btn ud-white-btn" href="{{ route('register') }}">
                                Qeydiyyat
                            </a>
                        @endguest
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
