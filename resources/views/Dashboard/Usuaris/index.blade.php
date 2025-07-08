<!DOCTYPE HTML>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Administració d'Usuaris - Pixel Bar</title>
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href="https://fonts.googleapis.com/css2?family=Press+Start+2P&display=swap" rel="stylesheet">
        <script src="https://unpkg.com/i18next@23.10.0/dist/umd/i18next.min.js"></script>
        <script src="{{ asset('js/idioma.js') }}"></script>
        <script src="{{ asset('js/particles.js') }}"></script>
        <script>
            particlesJS.load('particles-js', '{{ asset("json/particles.json") }}', function() {
                console.log('callback - particles.js config loaded');
            });

            // Handle dropdown functionality
            document.addEventListener('DOMContentLoaded', function() {
                const dropdown = document.querySelector('.dropdown');
                const dropbtn = document.querySelector('.dropbtn');
                const dropdownContent = document.querySelector('.dropdown-content');

                if (dropbtn && dropdownContent) {
                    dropbtn.addEventListener('click', function() {
                        dropdownContent.style.display = dropdownContent.style.display === 'block' ? 'none' : 'block';
                    });

                    // Close dropdown when clicking outside
                    window.addEventListener('click', function(event) {
                        if (!dropdown.contains(event.target)) {
                            dropdownContent.style.display = 'none';
                        }
                    });
                }

                // Funcionalitat de filtratge i ordenació
                initializeUserFilters();
            });

            function initializeUserFilters() {
                const searchInput = document.getElementById('user-search');
                const sortSelect = document.getElementById('user-sort');
                const userCards = Array.from(document.querySelectorAll('.user-link'));
                
                // Filtratge per nom
                if (searchInput) {
                    searchInput.addEventListener('input', function() {
                        const searchTerm = this.value.toLowerCase();
                        filterAndSortUsers(searchTerm, sortSelect ? sortSelect.value : 'name-asc');
                    });
                }

                // Ordenació
                if (sortSelect) {
                    sortSelect.addEventListener('change', function() {
                        const searchTerm = searchInput ? searchInput.value.toLowerCase() : '';
                        filterAndSortUsers(searchTerm, this.value);
                    });
                }

                function filterAndSortUsers(searchTerm, sortOption) {
                    let filteredUsers = userCards.filter(userLink => {
                        const userName = userLink.querySelector('h3').textContent.toLowerCase();
                        const userEmail = userLink.querySelector('.user-email').textContent.toLowerCase();
                        return userName.includes(searchTerm) || userEmail.includes(searchTerm);
                    });

                    // Ordenació
                    filteredUsers.sort((a, b) => {
                        switch (sortOption) {
                            case 'name-asc':
                                return a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent);
                            case 'name-desc':
                                return b.querySelector('h3').textContent.localeCompare(a.querySelector('h3').textContent);
                            case 'email-asc':
                                return a.querySelector('.user-email').textContent.localeCompare(b.querySelector('.user-email').textContent);
                            case 'email-desc':
                                return b.querySelector('.user-email').textContent.localeCompare(a.querySelector('.user-email').textContent);
                            case 'date-asc':
                                return new Date(a.querySelector('.user-date').textContent.split(': ')[1]) - new Date(b.querySelector('.user-date').textContent.split(': ')[1]);
                            case 'date-desc':
                                return new Date(b.querySelector('.user-date').textContent.split(': ')[1]) - new Date(a.querySelector('.user-date').textContent.split(': ')[1]);
                            case 'admin-first':
                                const aIsAdmin = a.querySelector('.user-admin') !== null;
                                const bIsAdmin = b.querySelector('.user-admin') !== null;
                                if (aIsAdmin && !bIsAdmin) return -1;
                                if (!aIsAdmin && bIsAdmin) return 1;
                                return a.querySelector('h3').textContent.localeCompare(b.querySelector('h3').textContent);
                            default:
                                return 0;
                        }
                    });

                    // Amagar tots els usuaris
                    userCards.forEach(user => user.style.display = 'none');

                    // Mostrar usuaris filtrats i ordenats
                    const container = document.querySelector('.users-grid');
                    filteredUsers.forEach(user => {
                        user.style.display = 'block';
                        container.appendChild(user);
                    });

                    // Mostrar missatge si no hi ha resultats
                    const noResults = document.getElementById('no-results');
                    if (filteredUsers.length === 0) {
                        noResults.style.display = 'block';
                    } else {
                        noResults.style.display = 'none';
                    }
                }
            }
        </script>
        <link rel="stylesheet" href="{{ asset('css/particles.css') }}">
        <style>
            /* Estils específics per a l'administració d'usuaris */
            .admin-container {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                background: rgba(10, 10, 30, 0.85);
                border-radius: 24px;
                box-shadow: 0 0 40px #00fff7, 0 0 10px #0ff;
                padding: 0;
                text-align: center;
                z-index: 1;
                width: 90%;
                max-width: 1200px;
                max-height: 85vh;
                overflow: hidden;
                display: flex;
                flex-direction: column;
                margin-top: 0;
            }

            .admin-header {
                position: sticky;
                top: 0;
                background: rgba(10, 10, 30, 0.95);
                padding: 30px 40px 20px 40px;
                border-radius: 24px 24px 0 0;
                z-index: 10;
                backdrop-filter: blur(10px);
                border-bottom: 2px solid rgba(0, 255, 247, 0.3);
            }
            
            .admin-title {
                font-family: 'Press Start 2P', monospace;
                color: #00fff7;
                font-size: 1.5rem;
                margin-bottom: 25px;
                text-shadow: 0 0 10px #00fff7;
            }

            .admin-content {
                flex: 1;
                overflow-y: auto;
                padding: 20px 40px 40px 40px;
                scrollbar-width: thin;
                scrollbar-color: #F20881 rgba(15, 15, 45, 0.3);
            }

            .admin-content::-webkit-scrollbar {
                width: 8px;
            }

            .admin-content::-webkit-scrollbar-track {
                background: rgba(15, 15, 45, 0.3);
                border-radius: 4px;
            }

            .admin-content::-webkit-scrollbar-thumb {
                background: #F20881;
                border-radius: 4px;
            }

            .admin-content::-webkit-scrollbar-thumb:hover {
                background: #00fff7;
            }

            .filters-container {
                display: flex;
                gap: 20px;
                justify-content: center;
                align-items: center;
                margin-bottom: 0;
                flex-wrap: wrap;
            }

            .filter-group {
                display: flex;
                flex-direction: column;
                align-items: center;
                gap: 8px;
            }

            .filter-input, .filter-select {
                font-family: 'Press Start 2P', monospace;
                background: rgba(15, 15, 45, 0.9);
                border: 2px solid #00fff7;
                border-radius: 8px;
                padding: 10px 14px;
                color: #fff;
                font-size: 0.65rem;
                outline: none;
                transition: all 0.3s ease;
                min-width: 180px;
            }

            .filter-input:focus, .filter-select:focus {
                border-color: #F20881;
                box-shadow: 0 0 10px rgba(242, 8, 129, 0.5);
            }

            .filter-input::placeholder {
                color: #aaa;
                font-family: 'Press Start 2P', monospace;
                font-size: 0.55rem;
            }

            .filter-select option {
                background: #0a0a1e;
                color: #fff;
                font-family: 'Press Start 2P', monospace;
                font-size: 0.65rem;
            }

            .filter-label {
                font-family: 'Press Start 2P', monospace;
                color: #00fff7;
                font-size: 0.7rem;
                text-shadow: 0 0 5px #00fff7;
                margin-bottom: 5px;
            }

            .stats-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
                gap: 15px;
                margin-bottom: 25px;
                max-width: 100%;
            }

            .stat-item {
                font-family: 'Press Start 2P', monospace;
                color: #fff;
                font-size: 0.6rem;
                text-align: center;
                padding: 8px 12px;
                background: rgba(15, 15, 45, 0.7);
                border: 1px solid #00fff7;
                border-radius: 8px;
                min-height: 60px;
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .stat-number {
                color: #F20881;
                font-size: 0.75rem;
                display: block;
                margin-top: 5px;
                font-weight: bold;
            }

            #no-results {
                display: none;
                color: #F20881;
                font-family: 'Press Start 2P', monospace;
                font-size: 1rem;
                margin-top: 30px;
                text-shadow: 0 0 5px #F20881;
            }
            
            .users-grid {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
                margin-top: 0;
            }
            
            .user-link {
                text-decoration: none;
                transition: transform 0.3s ease;
            }
            
            .user-link:hover {
                transform: scale(1.03);
            }
            
            .user-card {
                background: rgba(15, 15, 45, 0.9);
                border: 2px solid #F20881;
                border-radius: 12px;
                padding: 18px;
                box-shadow: 0 0 20px rgba(242, 8, 129, 0.3);
                transition: all 0.3s ease;
                cursor: pointer;
                min-height: 160px;
            }
            
            .user-card:hover {
                box-shadow: 0 0 30px rgba(242, 8, 129, 0.6);
                border-color: #00fff7;
            }
            
            .user-card h3 {
                font-family: 'Press Start 2P', monospace;
                color: #F7B14E;
                font-size: 0.9rem;
                margin-bottom: 12px;
                text-shadow:
                    -1px -1px 0 #1A535C,
                    1px -1px 0 #1A535C,
                    -1px  1px 0 #1A535C,
                    1px  1px 0 #1A535C,
                    0px  2px 0 #1A535C,
                    2px  0px 0 #1A535C,
                    0px -2px 0 #1A535C,
                    -2px  0px 0 #1A535C;
                line-height: 1.3;
                }   
            }
            
            .user-card p {
                font-family: 'Press Start 2P', monospace;
                color: #fff;
                font-size: 0.65rem;
                margin: 6px 0;
                line-height: 1.4;
            }
            
            .user-role {
                color: #F20881 !important;
                font-weight: bold;
            }
            
            .user-admin {
                color: #FFD700 !important;
            }
            
            .back-btn {
                position: fixed;
                top: 20px;
                left: 20px;
                z-index: 100;
                font-family: 'Press Start 2P', monospace;
                font-size: 0.8rem;
                color: #fff;
                background: transparent;
                border: 2px solid #00fff7;
                border-radius: 8px;
                padding: 12px 20px;
                cursor: pointer;
                box-shadow: 0 0 8px #00fff7;
                text-shadow: 0 0 8px #00fff7;
                transition: all 0.3s ease;
                text-decoration: none;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            
            .back-btn:hover {
                background: #00fff7;
                color: #0a0a1e;
                box-shadow: 0 0 20px #00fff7;
                text-decoration: none;
            }

            .language-selector {
                position: fixed;
                top: 20px;
                right: 30px;
                z-index: 100;
            }
            
            /* Responsive */
            /* Tablet */
            @media (max-width: 1024px) {
                .admin-container {
                    width: 95%;
                    max-height: 90vh;
                }

                .admin-header {
                    padding: 25px 30px 15px 30px;
                }

                .admin-content {
                    padding: 15px 30px 30px 30px;
                }
                
                .admin-title {
                    font-size: 1.3rem;
                    margin-bottom: 20px;
                }

                .stats-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                    margin-bottom: 20px;
                }

                .stat-item {
                    font-size: 0.55rem;
                    padding: 6px 10px;
                    min-height: 50px;
                }

                .stat-number {
                    font-size: 0.7rem;
                }

                .filters-container {
                    gap: 15px;
                    margin-bottom: 0;
                }

                .filter-input, .filter-select {
                    min-width: 160px;
                    font-size: 0.6rem;
                    padding: 8px 12px;
                }

                .filter-label {
                    font-size: 0.65rem;
                }

                .users-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 15px;
                }
                
                .user-card {
                    padding: 15px;
                    min-height: 140px;
                }

                .user-card h3 {
                    font-size: 0.8rem;
                    margin-bottom: 10px;
                }
                
                .user-card p {
                    font-size: 0.6rem;
                    margin: 5px 0;
                }
            }

            /* Móvil */
            @media (max-width: 768px) {
                .admin-container {
                    width: 98%;
                    max-height: 90vh;
                    top: 50%;
                    margin-top: 10px;
                }

                .admin-header {
                    padding: 15px 15px 10px 15px;
                }

                .admin-content {
                    padding: 10px 15px 20px 15px;
                }
                
                .admin-title {
                    font-size: 1.1rem;
                    margin-bottom: 15px;
                    line-height: 1.3;
                }

                .stats-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 8px;
                    margin-bottom: 15px;
                }

                .stat-item {
                    font-size: 0.5rem;
                    padding: 5px 8px;
                    min-height: 45px;
                }

                .stat-number {
                    font-size: 0.65rem;
                    margin-top: 3px;
                }

                .filters-container {
                    flex-direction: column;
                    gap: 12px;
                    margin-bottom: 0;
                }

                .filter-group {
                    width: 100%;
                }

                .filter-input, .filter-select {
                    min-width: 100%;
                    width: 100%;
                    font-size: 0.55rem;
                    padding: 8px 10px;
                }

                .filter-label {
                    font-size: 0.6rem;
                    margin-bottom: 3px;
                }
                
                .users-grid {
                    grid-template-columns: 1fr;
                    gap: 12px;
                }
                
                .user-card {
                    padding: 12px;
                    min-height: 120px;
                }

                .user-card h3 {
                    font-size: 0.75rem;
                    margin-bottom: 8px;
                    line-height: 1.2;
                }
                
                .user-card p {
                    font-size: 0.55rem;
                    margin: 4px 0;
                    line-height: 1.3;
                }

                .back-btn {
                    top: 8px;
                    left: 8px;
                    font-size: 0.6rem;
                    padding: 6px 10px;
                    z-index: 101;
                }

                .language-selector {
                    top: 8px;
                    right: 8px;
                    z-index: 101;
                }

                .language-selector .dropbtn {
                    font-size: 0.6rem;
                    padding: 6px 8px;
                }

                .language-selector .dropbtn img {
                    width: 18px !important;
                }

                .language-selector .dropdown-content {
                    right: 0;
                    min-width: 120px;
                }

                .language-selector .dropdown-content a {
                    font-size: 0.55rem;
                    padding: 8px 10px;
                }

                .language-selector .dropdown-content img {
                    width: 16px !important;
                }

                #no-results {
                    font-size: 0.8rem;
                    margin-top: 20px;
                    line-height: 1.4;
                }
            }

            /* Móvil pequeño */
            @media (max-width: 480px) {
                .admin-container {
                    width: 99%;
                    max-height: 92vh;
                    border-radius: 15px;
                    top: 52%;
                    margin-top: 15px;
                }

                .admin-header {
                    padding: 12px 10px 6px 10px;
                    border-radius: 15px 15px 0 0;
                }

                .admin-content {
                    padding: 6px 10px 12px 10px;
                }

                .admin-title {
                    font-size: 0.9rem;
                    margin-bottom: 10px;
                }

                .stats-container {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 5px;
                    margin-bottom: 10px;
                }

                .stat-item {
                    font-size: 0.4rem;
                    padding: 3px 5px;
                    min-height: 35px;
                }

                .stat-number {
                    font-size: 0.55rem;
                }

                .filter-input, .filter-select {
                    font-size: 0.45rem;
                    padding: 5px 6px;
                }

                .filter-label {
                    font-size: 0.5rem;
                }

                .user-card {
                    padding: 8px;
                    min-height: 100px;
                }

                .user-card h3 {
                    font-size: 0.65rem;
                    margin-bottom: 5px;
                }

                .user-card p {
                    font-size: 0.45rem;
                    margin: 2px 0;
                }

                .back-btn {
                    top: 5px;
                    left: 5px;
                    font-size: 0.5rem;
                    padding: 4px 8px;
                    z-index: 102;
                }

                .language-selector {
                    top: 5px;
                    right: 5px;
                    z-index: 102;
                }

                .language-selector .dropbtn {
                    font-size: 0.5rem;
                    padding: 4px 6px;
                }

                .language-selector .dropbtn img {
                    width: 16px !important;
                }

                .language-selector .dropdown-content {
                    min-width: 100px;
                }

                .language-selector .dropdown-content a {
                    font-size: 0.45rem;
                    padding: 6px 8px;
                }

                .language-selector .dropdown-content img {
                    width: 14px !important;
                }
            }
        </style>
    </head>
    <body>
        <div id="particles-js" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:-1;"></div>
        
        <!-- Botó de tornar enrere -->
        <a href="{{ route('dashboard') }}" class="back-btn">← Tornar</a>
        
        <!-- Dropdown d'idioma -->
        <div class="language-selector">
            <div class="dropdown">
                <button class="dropbtn">
                    <img src="{{ asset('img/flags/globe.svg') }}" alt="Lang" style="width:24px;vertical-align:middle;"> 
                    <span id="selected-lang">CA</span> ▼
                </button>
                <div class="dropdown-content">
                    <a href="#" data-lang="en"><img src="{{ asset('img/flags/en.svg') }}" alt="EN" style="width:20px;"> English</a>
                    <a href="#" data-lang="ca"><img src="{{ asset('img/flags/ca.svg') }}" alt="CA" style="width:20px;"> Català</a>
                    <a href="#" data-lang="es"><img src="{{ asset('img/flags/es.svg') }}" alt="ES" style="width:20px;"> Español</a>
                    <a href="#" data-lang="fr"><img src="{{ asset('img/flags/fr.svg') }}" alt="FR" style="width:20px;"> Français</a>
                    <a href="#" data-lang="ds"><img src="{{ asset('img/flags/de.svg') }}" alt="DE" style="width:20px;"> Deutsch</a>
                </div>
            </div>
        </div>
        
        <!-- Contenidor principal d'administració -->
        <div class="admin-container">
            <!-- Header fix amb títol, estadístiques i filtres -->
            <div class="admin-header">
                <div class="admin-title" data-i18n="admin.users.title">
                    Administració d'Usuaris
                </div>

                @if(isset($users) && $users->count() > 0)
                    <!-- Estadístiques -->
                    <div class="stats-container">
                        <div class="stat-item">
                            <div>Total Usuaris</div>
                            <span class="stat-number">{{ $users->count() }}</span>
                        </div>
                        <div class="stat-item">
                            <div>Administradors</div>
                            <span class="stat-number">{{ $users->where('is_admin', true)->count() }}</span>
                        </div>
                        <div class="stat-item">
                            <div>Usuaris Normals</div>
                            <span class="stat-number">{{ $users->where('is_admin', false)->count() }}</span>
                        </div>
                        <div class="stat-item">
                            <div>Emails Verificats</div>
                            <span class="stat-number">{{ $users->whereNotNull('email_verified_at')->count() }}</span>
                        </div>
                    </div>

                    <!-- Controls de filtratge i ordenació -->
                    <div class="filters-container">
                        <div class="filter-group">
                            <label class="filter-label" for="user-search">🔍 Cercar</label>
                            <input 
                                type="text" 
                                id="user-search" 
                                class="filter-input" 
                                placeholder="Nom o email..."
                                autocomplete="off"
                            >
                        </div>
                        <div class="filter-group">
                            <label class="filter-label" for="user-sort">📊 Ordenar per</label>
                            <select id="user-sort" class="filter-select">
                                <option value="name-asc">Nom (A-Z)</option>
                                <option value="name-desc">Nom (Z-A)</option>
                                <option value="email-asc">Email (A-Z)</option>
                                <option value="email-desc">Email (Z-A)</option>
                                <option value="date-desc">Més recent</option>
                                <option value="date-asc">Més antic</option>
                                <option value="admin-first">Admins primer</option>
                            </select>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Contingut scrollable -->
            <div class="admin-content">
                @if(isset($users) && $users->count() > 0)
                    <!-- Missatge sense resultats -->
                    <div id="no-results">
                        🚫 No s'han trobat usuaris que coincideixin amb la cerca
                    </div>
                
                    <div class="users-grid">
                        @foreach ($users as $user)
                            <a href="{{ route('admin.user', ['id' => $user->id]) }}" class="user-link">
                                <div class="user-card">
                                    <h3>{{ $user->name }}</h3>
                                    <p class="user-email"><strong>Email:</strong> {{ $user->email }}</p>
                                    <p class="{{ $user->is_admin ? 'user-admin' : 'user-role' }}">
                                        <strong>Rol:</strong> {{ $user->is_admin ? 'Administrador' : 'Usuari' }}
                                    </p>
                                    <p class="user-date"><strong>Registrat:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</p>
                                    @if($user->email_verified_at)
                                        <p style="color: #4CAF50;"><strong>✓</strong> Email verificat</p>
                                    @else
                                        <p style="color: #FF5722;"><strong>✗</strong> Email no verificat</p>
                                    @endif
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div style="color: #fff; font-family: 'Press Start 2P', monospace; font-size: 1rem; margin-top: 50px;">
                        No hi ha usuaris registrats
                    </div>
                @endif
            </div>
        </div>
    </body>
</html>
