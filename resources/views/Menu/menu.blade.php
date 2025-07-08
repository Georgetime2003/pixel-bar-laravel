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
    <!-- FI NAVBAR -->

    <div class="container">
        <!-- El títol ja està al navbar -->
        <!-- Hamburguesas -->
        <section class="expandable-section categoria-hamburguesas">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="hamburguesa" class="expand-title">🍔 Hamburguesas</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <img src="/img/icons/15_burger.png" alt="Pixel Burger" class="gif-icon">
                    <h3>Pixel Burger</h3>
                    <p data-i18n="pixel-burger-ingredients">Carne de res, queso cheddar, bacon y salsa especial.</p>
                    <span class="price">8,50€</span>
                </div>
                <div class="menu-item">
                    <img src="/img/icons/15_burger.png" alt="Burger" class="gif-icon">
                    <h3>Burger</h3>
                    <p data-i18n="burger-ingredients">Lechuga, tomate, cheddar, mayonesa</p>
                    <span class="price">8,50€</span>
                </div>
                <div class="menu-item">
                    <img src="/img/icons/15_burger.png" alt="Fire Burger" class="gif-icon">
                    <h3>🔥 Fire Burger</h3>
                    <p data-i18n="fire-burger-ingredients">Doble carne, jalapeños y salsa picante.</p>
                    <span class="price">9,50€</span>
                </div>
            </div>
        </section>
        <!-- Pizzas -->
        <section class="expandable-section categoria-pizzas">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="pizza" class="expand-title">🍕 Pizzas</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3 data-i18n="pizza-4-quesos">4 Quesos</h3>
                    <p data-i18n="pizza-4-quesos-ingredients">Mozarella, Gorgonzola, Parmesano, Queso de cabra</p>
                    <span class="price">8,50€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="pizza-barbacoa">Barbacoa</h3>
                    <p data-i18n="pizza-barbacoa-ingredients">Salsa BBQ, mozarella, Pollo, Cebolla morada, Beacon</p>
                    <span class="price">8,50€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="pizza-doble-pepperoni">Doble Pepperoni</h3>
                    <p data-i18n="pizza-barbacoa-ingredients">Mozarella</p>
                    <span class="price">8,50€</span>
                </div>
            </div>
        </section>
        <!-- Hot Dogs -->
        <section class="expandable-section categoria-hotdog">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="hot-dogs" class="expand-title">🌭 Hot Dogs</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3 data-i18n="hot-dog">Hot Dog</h3>
                    <p data-i18n="hot-dog-ingredients">Salsa cheddar</p>
                    <span class="price">4,50€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="hot-dog-especial">Hot Dog Especial</h3>
                    <p data-i18n="hot-dog-especial-ingredients">Cebolla frita crujiente o Patata paja</p>
                    <span class="price">6,00€</span>
                </div>
            </div>
        </section>
        <!-- Bebidas -->
        <section class="expandable-section categoria-bebidas">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="bebidas" class="expand-title">🥤 Bebidas</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3 data-i18n="agua">Agua</h3>
                    <span class="price">2,30€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="Agua-con-gas">Agua con gas</h3>
                    <span class="price">2,30€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="coca-cola">Coca-cola</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="coca-cola-zero">Coca-cola Zero</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="fanta-naranja">Fanta Naranja</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="fanta-Limon">Fanta Limón</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="nestea">Nestea</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="medbull">Redbull</h3>
                    <span class="price">3,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="monster">Monster</h3>
                    <span class="price">3,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="zumos">Zumos</h3>
                    <span class="price">2,50€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="tonica">Tónica</h3>
                    <span class="price">2,50€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="batido-cacao">Batido Cacao</h3>
                    <span class="price">2,50€</span>
                </div>
            </div>
        </section>
        <!-- Cerveza -->
        <section class="expandable-section categoria-cerveza">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="cerveza" class="expand-title">🍺 cerveza</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3>Alhambra 20 CL</h3>
                    <span class="price">2,40€</span>
                </div>
                <div class="menu-item">
                    <h3>Alhambra 33 CL</h3>
                    <span class="price">2,80€</span>
                </div>
                <div class="menu-item">
                    <h3>Alhambra Reserva</h3>
                    <span class="price">6,00€</span>
                </div>
                <div class="menu-item">
                    <h3>Estrella galicia</h3>
                    <span class="price">2,80</span>
                </div>
                <div class="menu-item">
                    <h3>Volldamm</h3>
                    <span class="price">3,00</span>
                </div>
                <div class="menu-item">
                    <h3>Corona</h3>
                    <span class="price">3,20</span>
                </div>
                <div class="menu-item">
                    <h3>Desperados</h3>
                    <span class="price">3,20</span>
                </div>
                <div class="menu-item">
                    <h3>Asashi</h3>
                    <span class="price">3,20</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="hidromiel">Hidromiel</h3>
                    <span class="price">3,20</span>
                </div>
            </div>
        </section>
        <!-- Aperitius -->
        <section class="expandable-section categoria-aperitivos">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="aperitivos" class="expand-title">🍟 Aperitivos</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3 data-i18n="patatas-fritas">Patatas firtas</h3>
                    <p data-i18n="patatas-fritas-ingredients">Papas fritas con sal</p>
                    <span class="price">5,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="patatas-bravas">Patatas Bravas</h3>
                    <p data-i18n="patatas-bravas-ingredients">Patatas Bravas</p>
                    <span class="price">5,75€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="patatas-jq">Patatas J & Q</h3>
                    <p data-i18n="patatas-jq-ingredients">Patatas jamón y queso</p>
                    <span class="price">6,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="nachos">Nachos</h3>
                    <p data-i18n="nachos-ingredients">Nachos</p>
                    <span class="price">8,75€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="takoyaki">Takoyaki</h3>
                    <p data-i18n="takoyaki-ingredients">6U</p>
                    <span class="price">7,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="gyozas">Gyozas</h3>
                    <p data-i18n="gyozas-ingredients">Gyozas carne o verdura (4U)</p>
                    <span class="price">7,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="nuggets">Chicken Nuggets</h3>
                    <p data-i18n="nuggets-ingredients">Nuggets de pollo</p>
                    <span class="price">7,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="mochi">Mochi</h3>
                    <p data-i18n="mochi-ingredients">Mochi de té macha</p>
                    <span class="price">7,00€</span>
                </div>
                <div class="menu-item">
                    <h3 data-i18n="coulant">Coulant</h3>
                    <p data-i18n="coulant-ingredients">Mochi de té macha</p>
                    <span class="price">7,00€</span>
                </div>
            </div>
        </section>
        <!-- Combo -->
        <section class="expandable-section categoria-combo">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span class="expand-title">🥡 Combo</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <h3>COMBO</h3>
                    <p data-i18n="combo">H.crispy chicken o Pizza + Patatas + Refresco o Cerveza</p>
                    <span class="price">10,00</span>
                </div>
            </div>
        </section>
        <!-- Postres -->
        <section class="expandable-section categoria-postres">
            <h2 class="expandable-header">
                <span class="arrow">▼</span>
                <span data-i18n="postres" class="expand-title">🍰 Postres</span>
            </h2>
            <div class="section-content">
                <div class="menu-item">
                    <img src="pixelcake.gif" alt="Pixel Cake" class="gif-icon">
                    <h3>🎂 Pixel Cake</h3>
                    <p data-i18n="pixel-cake-ingredients">Delicioso pastel de chocolate con trozos de pixel.</p>
                    <span class="price">4,00€</span>
                </div>
                <div class="menu-item">
                    <img src="icecream.gif" alt="Helado" class="gif-icon">
                    <h3 data-i18n="helado-pixelado">🍦 Helado Pixelado</h3>
                    <p data-i18n="helado-pixelado-ingredients">Helado de vainilla con chispas de chocolate.</p>
                    <span class="price">3,50€</span>
                </div>
            </div>
        </section>
    </div>
    <script src="{{ asset("js/menuPixel.js") }}"></script>
    <!-- El control del menú d'idiomes ara està a idioma.js -->
</body>
</html>