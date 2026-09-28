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
            <p class="eyebrow">FIRST WEBSITE</p>
            <h1>This is a header!</h1>
            <a class="test-link" href="{{ route('testpage') }}">Go to test page</a>
        </header>

        <section class="form-card" aria-labelledby="form-title">
            <h2 id="form-title">Let’s keep in touch</h2>
            <p class="form-intro">Share your name and email address to get started.</p>

            <form class="contact-form" action="{{ route('formsubmitted') }}" method="POST">
                @csrf

                <div class="form-field">
                    <label for="fullname">Full name</label>
                    <input type="text" id="fullname" name="fullname" placeholder="e.g. Alex Chen" autocomplete="name" required>
                </div>

                <div class="form-field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="you@example.com" autocomplete="email" required>
                </div>

                <button class="submit-button" type="submit">Submit</button>
            </form>
        </section>

        <footer>
            <h1>This is a footer!</h2>
        </footer>
    </main>
</body>

</html>