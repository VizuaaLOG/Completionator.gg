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
        Vite::withEntryPoints(['resources/js/main.ts', 'resources/scss/app.scss'])
    }}
</head>
<body class="h-100">
<div id="app" class="h-100"></div>
</body>
</html>
