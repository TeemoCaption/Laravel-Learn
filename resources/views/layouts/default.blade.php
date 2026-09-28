<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | First Website</title>
    @vite('resources/css/app.css')
    @vite('resources/js/app.ts')
</head>

<body>
    <main class="page-shell">
        <header class="page-heading">
            @yield("header")
        </header>

        <section class="form-card" aria-labelledby="form-title">
            @yield("maincontent")
        </section>

        <footer>
            @yield("footer")
        </footer>
    </main>
</body>

</html>