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
        @yield('content')
    </div>
</body>
</html>