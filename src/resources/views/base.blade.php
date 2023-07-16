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
<div class="bg-body h-100 overflow-hidden d-flex flex-column">
    <nav class="navbar navbar-expand fixed-top bg-body-tertiary">
        <div class="container-fluid">
            <RouterLink :to="{ name: 'home' }"
                        class="navbar-brand"
            >
                Completionator
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
            <x-layout.side-menu.side-menu />
        </div>

        <div class="col overflow-y-auto overflow-x-hidden main-content-wrapper pb-5 px-0 position-relative"
             style="margin-right: 12px;"
        >
            @yield('content')
        </div>
    </div>
</div>

@stack('modals')
</body>
</html>
