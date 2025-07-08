<?php
   session_start();

   if($_SERVER['REQUEST_METHOD'] == 'POST') {
       $username = $_POST['username'];
       $password = $_POST['password'];

       // Here you would typically check the credentials against a database
       if($username == 'admin' && $password == 'password') {
           $_SESSION['loggedin'] = true;
           header('Location: dashboard.php');
           exit();
       } else {
           $error = "Invalid username or password";
       }
   }


?>
<!DOCTYPE html>
<html lang="en">
<head>
          <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Index Page</title>
        <link rel="stylesheet" href="{{ asset("css/style.css") }}">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/i18next@23.10.0/dist/umd/i18next.min.js"></script>
        <script src="{{ asset("js/idioma.js") }}"></script>
        <script src="{{ asset("js/particles.js") }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset("json/particles.json") }}', function() {
                console.log('callback - particles.js config loaded');
            });
        </script>
        <link rel="stylesheet" href="{{ asset("css/particles.css") }}">
        <link rel="stylesheet" href="{{ asset("css/login.css") }}">
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
            <span class="navbar-title">🍔 Login 🎮</span>
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
    <style>

    </style>
    <!-- FI NAVBAR -->
    <div class="pixel-card">
        <h2 data-i18n="login">Login</h2>
        <?php if(isset($error)): ?>
            <div class="error, pixel-error" ><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <label for="email" data-i18n="username">Email:</label>
                <input type="text" id="email" name="email" class="pixel-input" required>
            </div>
            <div class="form-group">
                <label for="password" data-i18n="password" >Password:</label>
                <input type="password" id="password" name="password"  class="pixel-input" required>
            </div>
            <button type="submit" i18n="login" class="pixel-btn">Login</button>
            <p data-i18n="no-account">Don't have an account?</p> 
            <a href="{{ route('register')}}" class="pixel-link" data-i18n="register-here">Register here</a>
        </form>
    </div>
    </body>
</html>


    