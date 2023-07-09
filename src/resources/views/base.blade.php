<!doctype html>
<html lang="en"
      data-bs-theme="dark"
      class="h-100"
>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    {{
        Vite::withEntryPoints(['resources/js/app.js', 'resources/scss/app.scss'])
    }}
</head>
<body class="h-100">
<div class="bg-body h-100 overflow-x-hidden d-flex flex-column">
    <nav class="navbar navbar-expand fixed-top bg-body-tertiary">
        <div class="container-fluid">
            <RouterLink :to="{ name: 'home' }"
                        class="navbar-brand"
            >
                Completionist
            </RouterLink>

            <div class="d-flex flex-grow-1 align-items-center gap-3 justify-content-end">
                <div class="d-none d-md-flex flex-grow-1">
                    <input class="flex-grow-1 form-control" type="search" name="search" aria-label="Search"
                           placeholder="Search by game">
                </div>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a aria-expanded="false"
                           class="nav-link dropdown-toggle"
                           data-bs-toggle="dropdown"
                           role="button"
                        >
                            Tom
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">Account Settings</a></li>
                            <li><a class="dropdown-item" href="#">Admin Settings</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" href="#">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="row flex-nowrap h-100" style="margin-top: 56px;">
        <div class="col-auto d-none d-md-flex bg-dark-subtle h-100">
            <div class="side-menu-wrapper ps-3 py-3 overflow-y-auto">
                <!-- Example split danger button -->
                <div class="btn-group w-100">
                    <a href="{{ route('games.create') }}"
                       class="btn btn-primary"
                    >
                        Add Game
                    </a>

                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Add Collection</a></li>
                        <li><a class="dropdown-item" href="{{ route('platforms.create') }}">Add Platform</a></li>
                    </ul>
                </div>

                <ul class="list-unstyled d-flex flex-column gap-4 mt-4">
                    <li class="d-flex flex-column gap-2">
                        <a href="{{ route('dashboard') }}"
                           class="menu-link ms-0 text-body text-decoration-none d-flex justify-content-between align-items-center"
                        >
                            <strong>Your Dashboard</strong>
                        </a>
                    </li>

                    <li class="d-flex flex-column gap-1">
                        <a href="#"
                           class="menu-link ms-0 text-body text-decoration-none d-flex justify-content-between align-items-center"
                        >
                            <strong class="flex-grow-1">Backlog</strong>

                            <div class="badge text-bg-secondary">23</div>
                        </a>

                        <ul class="list-unstyled d-flex flex-column gap-1">
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                                >
                                    Playing

                                    <div class="badge text-bg-secondary">23</div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                                >
                                    Completed

                                    <div class="badge text-bg-secondary">23</div>
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none d-flex justify-content-between align-items-center"
                                >
                                    Retired

                                    <div class="badge text-bg-secondary">23</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="d-flex flex-column gap-2">
                        <strong>
                            <a href="#"
                               class="menu-link ms-0 text-body text-decoration-none"
                            >
                                Platforms
                            </a>
                        </strong>

                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none"
                                >
                                    Gaming Rig
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none"
                                >
                                    Xbox
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none"
                                >
                                    Android
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="d-flex flex-column gap-2">
                        <strong>
                            <a href="#"
                               class="menu-link ms-0 text-body text-decoration-none"
                            >
                                Collections
                            </a>
                        </strong>

                        <ul class="list-unstyled d-flex flex-column gap-2">
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none"
                                >
                                    Perfection
                                </a>
                            </li>
                            <li>
                                <a href="#"
                                   class="menu-link text-body text-decoration-none"
                                >
                                    Halo
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col overflow-y-auto main-content-wrapper pb-5 ps-3 pe-4">
            @yield('content')
        </div>
    </div>
</div>
</body>
</html>
