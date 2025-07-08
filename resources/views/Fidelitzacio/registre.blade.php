<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index Page</title>
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/i18next@23.10.0/dist/umd/i18next.min.js") }}"></script>
        <script src="{{ asset("js/idioma.js") }}"></script>
        <script src="{{ asset("js/particles.js") }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset("json/particles.json") }}', function() {
                console.log('callback - particles.js config loaded');
            });
        </script>
        <link rel="stylesheet" href="{{ asset("css/particles.css") }}">
        <link rel="stylesheet" href="{{ asset("css/register.css") }}">
        <link rel="stylesheet" href="{{ asset("css/menuPixel.css") }}">



</head>
<body>
<div id="particles-js" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:-1;"></div>
     <!-- NAVBAR FIXED -->
    <nav class="pixel-navbar">
        <div class="navbar-left">
            <a href="/"><img src="/img/logo.png" alt="Logo Pixel Bar" class="navbar-logo"></a>
        </div>
        <div class="navbar-center">
            <span class="navbar-title" data-i18n="register">🍔 Registre🎮</span>
        </div>
        <div class="navbar-right">
            <div class="dropdown">
                <button class="dropbtn"><img src="/img/flags/es.svg" alt="Lang" style="width:24px;vertical-align:middle;"> <span id="selected-lang">ES</span> ▼</button>
                <div class="dropdown-content">
                    <a href="#" data-lang="en"><img src="/img/flags/en.svg" alt="EN" style="width:20px;"> English</a>
                    <a href="#" data-lang="ca"><img src="/img/flags/ca.svg" alt="CA" style="width:20px;"> Català</a>
                    <a href="#" data-lang="es"><img src="/img/flags/es.svg" alt="ES" style="width:20px;"> Español</a>
                    <a href="#" data-lang="fr"><img src="/img/flags/fr.svg" alt="FR" style="width:20px;"> Français</a>
                    <a href="#" data-lang="ds"><img src="/img/flags/de.svg" alt="DE" style="width:20px;"> Deutsch</a>
                </div>
            </div>
        </div>
    </nav>
    
    <!-- NAVBAR END -->

    <div class="login-container pixel-card">
        <h2>Register</h2>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="form-group">
                <label data-i18n="name" for="name">Name:</label>
                <input type="text" id="name" name="name" class="pixel-input" required>
            </div>
            <div class="form-group">
                <label data-i18n="username" for="email">Email:</label>
                <input type="text" id="email" name="email" class="pixel-input" required>
            </div>
            <div class="form-group">
                <label data-i18n="password" for="password">Password:</label>
                <input type="password" id="password" name="password" class="pixel-input" required>
            </div>
            <div class="form-group">
                <label data-i18n="confirm-password" for="password_confirmation">Confirm Password:</label>
                <input type="password" id="password_confirmation" class="pixel-input" name="password_confirmation" required>
            </div>
            <div class="form-group">
                <button type="submit" data-i18n="register" class="pixel-btn">Register</button>
            </div>
            <div class="form-group">
                <p data-i18n="already-account">Already have an account?</p>
                <a data-i18n="login-here" href="{{ route('login')}}" class="pixel-link">Login here</a>
            </div>
        </form>
        <?php
        if (isset($_GET['error'])) {
            $error = htmlspecialchars($_GET['error']);
            echo "<p class='error-message'>$error</p>";
        }
        if (isset($_GET['success'])) {
            $success = htmlspecialchars($_GET['success']);
            echo "<p class='success-message'>$success</p>";
        }
        ?>
    </div>

    </body>
</html>