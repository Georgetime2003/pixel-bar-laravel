
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta - Pixel Bar</title>
    <link rel="stylesheet" href="{{ asset("css/style.css") }}">
    <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/i18next@23.10.0/dist/umd/i18next.min.js") }}"></script>
    <script src="{{ asset("js/idioma.js") }}"></script>
    <script src="{{ asset("js/particles.js") }}"></script>
    <script>
        particlesJS.load('particles-js', '{{ asset("json/particles.json") }}', function() {
            console.log('callback - particles.js config loaded');
        });
        
        // Handle dropdown functionality
        document.addEventListener('DOMContentLoaded', function() {
            const dropdown = document.querySelector('.dropdown');
            const dropbtn = document.querySelector('.dropbtn');
            const dropdownContent = document.querySelector('.dropdown-content');

            dropbtn.addEventListener('click', function() {
                dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
            });

            // Close dropdown when clicking outside
            window.addEventListener('click', function(event) {
                if (!dropdown.contains(event.target)) {
                    dropdownContent.style.display = 'none';
                }
            });
        });
    </script>
    <link rel="stylesheet" href="{{ asset("css/particles.css") }}">
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
            <span class="navbar-title">🍔 Carta 🎮</span>
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

    <div class="container">
        <div class="menu-container">
            <h1 class="menu-title">Menú Administrador</h1>
            <div class="menu-item">
                <a href="{{ route('admin.users') }}" class="menu-link">Gestión de Usuarios</a>
            </div>
            <div class="menu-item">
                <a href="/admin/products" class="menu-link">Gestión de Productos</a>
            </div>
            <div class="menu-item">
                <a href="/admin/orders" class="menu-link">Gestión de Pedidos</a>
            </div>
            <div class="menu-item">
                <a href="/admin/reports" class="menu-link">Informes y Estadísticas</a>
            </div>
        </div>
    </div>

</body>
</html>