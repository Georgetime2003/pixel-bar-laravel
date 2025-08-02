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
            // Handle language dropdown
            const langDropdown = document.querySelector('.navbar-right .dropdown');
            const langDropbtn = langDropdown.querySelector('.dropbtn');
            const langDropdownContent = langDropdown.querySelector('.dropdown-content');

            if (langDropbtn && langDropdownContent) {
                langDropbtn.addEventListener('click', function() {
                    langDropdownContent.style.display = langDropdownContent.style.display === 'block' ? 'none' : 'block';
                });

                // Close dropdown when clicking outside
                window.addEventListener('click', function(event) {
                    if (!langDropdown.contains(event.target)) {
                        langDropdownContent.style.display = 'none';
                    }
                });
            }
        });
    </script>
    <link rel="stylesheet" href="{{ asset("css/particles.css") }}">
    <link rel="stylesheet" href="{{ asset("css/menuPixel.css") }}">
    <link rel="stylesheet" href="{{ asset("css/menuAdmin.css") }}">
</head>

<body>
      <div id="particles-js" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:-1;"></div>
    <!-- Botó de tornar enrere -->
        <a href="{{ route('dashboard') }}" class="back-btn"><span>←</span>  Tornar</a>
        
    <!-- Overlay para el fondo borroso -->
    <div class="modal-overlay" id="modal-overlay" style="display: none;"></div>
    
    <!-- Formulari d'afegir producte (hidden) -->
    <div class="add-product-container" id="add-product-form" style="display: none;">
        <div class="add-product-title">Afegir Nou Producte</div>
        <button type="button" class="close-form-btn" onclick="hideAddForm()">✕</button>
        <form action="{{ route('admin.products.create') }}" method="POST" class="product-form">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Nom del Producte:</label>
                <input type="text" id="name" name="name" class="form-input" placeholder="Introdueix el nom..." required>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Descripció:</label>
                <input type="text" id="description" name="description" class="form-input" placeholder="Introdueix la descripció..." required>
            </div>
            
            <div class="form-group">
                <label for="price" class="form-label">Preu (€):</label>
                <input type="number" id="price" name="price" step="0.01" class="form-input" placeholder="0.00" required>
            </div>

            <div class="form-group">
                <label for="image" class="form-label">Traducció:</label>
                <input type="checkbox" id="image" name="image" class="form-input" value="1">
            </div>
            
            <div class="form-group">
                <label for="category_id" class="form-label">Categoria:</label>
                <select id="category_id" name="category_id" class="form-input" required>
                    <option value="">Selecciona una categoria...</option>
                    @if(isset($categories) && $categories->count() > 0)
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            
            <button type="submit" class="add-product-btn">Afegir Producte</button>
        </form>
    </div>
  
    <!-- Llista de productes -->
    <div class="products-list-container">
        <div class="products-header">
            <div class="products-title">Llista de Productes</div>
            <button type="button" class="show-add-form-btn" onclick="showAddForm()">+ Afegir Nou Producte</button>
            
            <!-- Controls de cerca i filtrat -->
            <div class="search-controls">
                <div class="search-group">
                    <label for="search-name" class="search-label">Cerca per nom:</label>
                    <input type="text" id="search-name" class="search-input" placeholder="Nom del producte...">
                </div>
                
                <div class="search-group">
                    <label for="search-content" class="search-label">Cerca per contingut:</label>
                    <input type="text" id="search-content" class="search-input" placeholder="Descripció...">
                </div>
             
                
                <div class="search-group">
                    <label for="sort-select" class="search-label">Ordenar per:</label>
                    <select id="sort-select" class="sort-select">
                        <option value="name-asc">Nom (A-Z)</option>
                        <option value="name-desc">Nom (Z-A)</option>
                        <option value="price-asc">Preu (menor a major)</option>
                        <option value="price-desc">Preu (major a menor)</option>
                    </select>
                </div>
                <div class="search-group">
                    <label for="category-filter" class="search-label">Filtrar per Categoria:</label>
                    <select id="category-filter" class="sort-select">
                        <option value="">Totes les categories</option>
                        @if(isset($categories) && $categories->count() > 0)
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
               
                
                <button type="button" id="clear-filters" class="clear-filters-btn">Netejar filtres</button>
            </div>
        </div>
        
        <div class="products-content">
            @if(isset($products) && $products->count() > 0)
                <ul class="products-grid">
                    @foreach ($products as $product)
                    <li class="product-card" data-category-id="{{ $product->category_id ?? '' }}">
                        <div>
                            <span class="product-name">{{ $product->name }}</span>
                            <span class="product-description">{{ $product->description }}</span>
                            <span class="product-price">{{ number_format($product->price, 2) }} €</span>
                            @if($product->category)
                                <span class="product-category">Categoria: {{ $product->category->name }}</span>
                            @endif
                        </div>
                        <form action="{{ route('admin.products.delete') }}" method="POST" class="delete-form" onsubmit="return confirm('¿Estás seguro de que quieres eliminar este producto?');">
                            @csrf
                            <input type="hidden" name="id" value="{{ $product->id }}">
                            <button type="submit" class="delete-button">
                                🗑️ Eliminar
                            </button>
                        </form>
                    </li>
                    @endforeach
                </ul>
            @else
                <div class="no-products">
                    No hi ha productes registrats
                </div>
            @endif
        </div>
    </div>
           
    <script>
        // Funciones para mostrar/ocultar el formulario
        function showAddForm() {
            document.getElementById('add-product-form').style.display = 'block';
            document.getElementById('modal-overlay').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevenir scroll del body
        }
        
        function hideAddForm() {
            document.getElementById('add-product-form').style.display = 'none';
            document.getElementById('modal-overlay').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restaurar scroll del body
        }

        // Cerrar modal al hacer clic en el overlay
        document.getElementById('modal-overlay').addEventListener('click', hideAddForm);

        // Cerrar modal con tecla Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                hideAddForm();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const searchName = document.getElementById('search-name');
            const searchContent = document.getElementById('search-content');
            const sortSelect = document.getElementById('sort-select');
            const categoryFilter = document.getElementById('category-filter');
            const clearFilters = document.getElementById('clear-filters');
            const productCards = document.querySelectorAll('.product-card');
            const noProductsMessage = document.querySelector('.no-products');
            
            // Function to show/hide no products message
            function toggleNoProductsMessage() {
                const visibleCards = document.querySelectorAll('.product-card:not([style*="display: none"])');
                if (noProductsMessage) {
                    if (visibleCards.length === 0 && productCards.length > 0) {
                        noProductsMessage.style.display = 'block';
                        noProductsMessage.textContent = 'No s\'han trobat productes amb aquests filtres';
                    } else {
                        noProductsMessage.style.display = 'none';
                    }
                }
            }
            
            // Function to filter and sort products
            function filterAndSort() {
                const nameFilter = searchName.value.toLowerCase().trim();
                const contentFilter = searchContent.value.toLowerCase().trim();
                const categoryFilterValue = categoryFilter.value.trim();
                const sortValue = sortSelect.value;
                
                // Convert NodeList to Array for sorting
                const cardsArray = Array.from(productCards);
                
                // Filter products
                cardsArray.forEach(card => {
                    const productName = card.querySelector('.product-name').textContent.toLowerCase();
                    const productDesc = card.querySelector('.product-description').textContent.toLowerCase();
                    const productCategoryId = card.getAttribute('data-category-id') || '';
                    
                    const nameMatch = !nameFilter || productName.includes(nameFilter);
                    const contentMatch = !contentFilter || productDesc.includes(contentFilter);
                    const categoryMatch = !categoryFilterValue || productCategoryId === categoryFilterValue;
                    
                    if (nameMatch && contentMatch && categoryMatch) {
                        card.style.display = 'flex';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Sort visible products
                const visibleCards = cardsArray.filter(card => card.style.display !== 'none');
                
                visibleCards.sort((a, b) => {
                    const aName = a.querySelector('.product-name').textContent.toLowerCase();
                    const bName = b.querySelector('.product-name').textContent.toLowerCase();
                    const aPrice = parseFloat(a.querySelector('.product-price').textContent.replace('€', '').replace(',', '.'));
                    const bPrice = parseFloat(b.querySelector('.product-price').textContent.replace('€', '').replace(',', '.'));
                    
                    switch(sortValue) {
                        case 'name-asc':
                            return aName.localeCompare(bName);
                        case 'name-desc':
                            return bName.localeCompare(aName);
                        case 'price-asc':
                            return aPrice - bPrice;
                        case 'price-desc':
                            return bPrice - aPrice;
                        default:
                            return 0;
                    }
                });
                
                // Reorder DOM elements
                const container = document.querySelector('.products-grid');
                if (container) {
                    visibleCards.forEach(card => {
                        container.appendChild(card);
                    });
                }
                
                toggleNoProductsMessage();
            }
            
            // Event listeners
            searchName.addEventListener('input', filterAndSort);
            searchContent.addEventListener('input', filterAndSort);
            sortSelect.addEventListener('change', filterAndSort);
            categoryFilter.addEventListener('change', filterAndSort);
            
            // Clear filters
            clearFilters.addEventListener('click', function() {
                searchName.value = '';
                searchContent.value = '';
                categoryFilter.value = '';
                sortSelect.value = 'name-asc';
                
                productCards.forEach(card => {
                    card.style.display = 'flex';
                });
                
                filterAndSort(); // Re-sort with default order
            });
            
            // Initial sort
            filterAndSort();
        });
    </script>
 
</body>
</html>
