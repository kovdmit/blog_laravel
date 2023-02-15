<!-- Topbar Start -->
<div class="container-fluid d-none d-lg-block">
    <div class="row align-items-center bg-dark px-lg-5">
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-sm bg-dark p-0">
                <ul class="navbar-nav ml-n2">
                    <li class="nav-item border-right border-secondary">
                        <a class="nav-link text-body small">{{ now()->format('d F Y') }}</a>
                    </li>

                    @guest()
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="{{ route('user.registration.create') }}">Регистрация</a>
                        </li>
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="{{ route('user.login.create') }}">Войти</a>
                        </li>
                    @endguest

                    @auth()
                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small">Привет, {{ auth()->user()->name }}</a>
                        </li>

                        @if(auth()->user()->staff === 3)
                            <li class="nav-item border-right border-secondary">
                                <a class="nav-link text-body small" href="{{ route('admin.index') }}">Панель администратора</a>
                            </li>
                        @endif

                        <li class="nav-item border-right border-secondary">
                            <a class="nav-link text-body small" href="{{ route('user.logout') }}">Выйти</a>
                        </li>
                    @endauth

                </ul>
            </nav>
        </div>
        <div class="col-lg-3 text-right d-none d-md-block">
            <nav class="navbar navbar-expand-sm bg-dark p-0">
                <ul class="navbar-nav ml-auto mr-n2">
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://t.me/i76700" target="_blank"><small class="fab fa-telegram-plane"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://vk.com/kovdmit" target="_blank"><small class="fab fa-vk"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://www.linkedin.com/in/kovdmit/" target="_blank"><small class="fab fa-linkedin-in"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://twitter.com/kovdmit" target="_blank"><small class="fab fa-twitter"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://www.facebook.com/kovdmit" target="_blank"><small class="fab fa-facebook-f"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://www.instagram.com/kovdmit/" target="_blank"><small class="fab fa-instagram"></small></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-body" href="https://www.youtube.com/@user-uo2yh9ij4w/" target="_blank"><small class="fab fa-youtube"></small></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row align-items-center bg-white py-3 px-lg-5">
        <div class="col-lg-4">
            <a href="{{ route('home') }}" class="navbar-brand p-0 d-none d-lg-block">
                <h1 class="m-0 display-4 text-uppercase text-primary">Fresh<span class="text-secondary font-weight-normal">News</span></h1>
            </a>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
            <a href="https://htmlcodex.com"><img class="img-fluid" src="{{ asset('assets/front/img/ads-728x90.png') }}" alt="ad"></a>
        </div>
    </div>
</div>
<!-- Topbar End -->

<!-- Navbar Start -->
<div class="container-fluid p-0">
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-2 py-lg-0 px-lg-5">
        <a href="index.html" class="navbar-brand d-block d-lg-none">
            <h1 class="m-0 display-4 text-uppercase text-primary">Fresh<span class="text-white font-weight-normal">News</span></h1>
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-between px-0 px-lg-3" id="navbarCollapse">
            <div class="navbar-nav mr-auto py-0">
                <a href="{{ route('home') }}" class="nav-item nav-link active">Главная</a>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Категории</a>
                    <div class="dropdown-menu rounded-0 m-0">
                        <a href="{{ route('category.index') }}" class="dropdown-item"><strong>Все категории</strong></a>
                        @foreach($categories as $slug => $category)
                            <a href="{{ route('category.show', ['slug' => $slug]) }}" class="dropdown-item">{{ $category }}</a>
                        @endforeach

                    </div>
                </div>
            </div>
            <form action="{{ route('post.search') }}">
                <div class="input-group ml-auto d-none d-lg-flex" style="width: 100%; max-width: 300px;">
                    <input type="text" name="s" class="form-control border-0" placeholder="Я ищу...">
                    <div class="input-group-append">
                        <button class="input-group-text bg-primary text-dark border-0 px-3"><i
                                class="fa fa-search"></i></button>
                    </div>
                </div>
            </form>
        </div>
    </nav>
</div>
<!-- Navbar End -->
