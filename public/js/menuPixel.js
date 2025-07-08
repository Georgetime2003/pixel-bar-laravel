  // Expansió/collapsat de seccions en el apartat del menu (amb animacions suaves)
    document.addEventListener('DOMContentLoaded', function () {
        const sections = document.querySelectorAll('.expandable-section');
        
        // Función para animar el colapsado
        function collapseContent(content) {
            content.classList.add('collapsing');
            content.style.maxHeight = content.scrollHeight + 'px';
            content.style.overflow = 'hidden';
            content.style.transition = 'max-height 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.2s ease-out, transform 0.3s ease-out';
            
            // Forzar reflow antes de aplicar la animación
            content.offsetHeight;
            
            content.style.maxHeight = '0';
            content.style.opacity = '0';
            
            setTimeout(() => {
                content.style.display = 'none';
                content.classList.remove('collapsing');
            }, 300);
        }
        
        // Función para animar el desplegado
        function expandContent(content) {
            content.classList.add('expanding');
            content.style.display = '';
            content.style.maxHeight = '0';
            content.style.opacity = '0';
            content.style.overflow = 'hidden';
            content.style.transition = 'max-height 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94), opacity 0.2s ease-out, transform 0.3s ease-out';
            
            // Forzar reflow
            content.offsetHeight;
            
            const scrollHeight = content.scrollHeight;
            content.style.maxHeight = scrollHeight + 'px';
            content.style.opacity = '1';
            
            // Remover max-height después de la animación para permitir contenido dinámico
            setTimeout(() => {
                content.style.maxHeight = 'none';
                content.style.overflow = 'visible';
                content.classList.remove('expanding');
            }, 300);
        }
        
        sections.forEach((section, idx) => {
            const header = section.querySelector('.expandable-header');
            const content = section.querySelector('.section-content');

            // Inicializar estado
            if (idx !== 0) {
                content.style.display = 'none';
                content.style.maxHeight = '0';
                content.style.opacity = '0';
                header.classList.remove('open');
            } else {
                header.classList.add('open');
                content.style.maxHeight = 'none';
                content.style.opacity = '1';
            }

            header.addEventListener('click', function () {
                const isOpen = header.classList.contains('open');
                
                // Cerrar todas las secciones
                sections.forEach(otherSection => {
                    const otherHeader = otherSection.querySelector('.expandable-header');
                    const otherContent = otherSection.querySelector('.section-content');
                    
                    if (otherHeader.classList.contains('open')) {
                        otherHeader.classList.remove('open');
                        collapseContent(otherContent);
                    }
                });

                // Si la sección actual no estaba abierta, abrirla
                if (!isOpen) {
                    header.classList.add('open');
                    expandContent(content);
                }
            });
        });
    });