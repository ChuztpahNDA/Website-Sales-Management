<header>
    @include('main.blocks.sidebar')
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" style="margin-left: 5px">
        <div class="container-fluid">

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <!-- dropdown -->
            <form action="{{route('postLogout')}}" method="POST">
                @csrf
                <ul class="navbar-nav d-flex flex-row">
                    <li class="nav-item me-3 me-lg-0 dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user">@yield('nameAccount')</i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">Thông tin tài khoản</a>
                            </li>
                            <li>
                                <button class="dropdown-item fa fa-sign-out" type="submit"> Đăng xuất</button>
                            </li>
                        </ul>
                    </li>
                </ul>
            </form>

        </div>
    </nav><!-- NavBar END -->
</header>
