/**
 * JavaScript principal para el sitio web
 */

// Variables globales
const SITE = {
    name: 'Mi Sitio Web',
    version: '1.0.0',
    ready: false
};

// Función de inicialización
document.addEventListener('DOMContentLoaded', function() {
    console.log(`%c${SITE.name} v${SITE.version} cargado`, 'color: #3498db; font-weight: bold;');
    
    // Inicializar funcionalidades
    initNavigation();
    initFormValidation();
    initSmoothScroll();
    
    SITE.ready = true;
});

/**
 * Inicializar navegación
 */
function initNavigation() {
    const navLinks = document.querySelectorAll('.nav-link');
    
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            // Remover clase active de todos
            navLinks.forEach(l => l.classList.remove('active'));
            // Agregar a actual
            this.classList.add('active');
        });
    });
    
    console.log('✓ Navegación inicializada');
}

/**
 * Validar formulario de contacto
 */
function initFormValidation() {
    const form = document.querySelector('.contact-form');
    
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name');
        const email = document.getElementById('email');
        const subject = document.getElementById('subject');
        const message = document.getElementById('message');
        
        let isValid = true;
        
        // Validar nombre
        if (!name.value.trim()) {
            showFieldError(name, 'El nombre es requerido');
            isValid = false;
        }
        
        // Validar email
        if (!email.value.trim() || !isValidEmail(email.value)) {
            showFieldError(email, 'Email inválido');
            isValid = false;
        }
        
        // Validar asunto
        if (!subject.value.trim()) {
            showFieldError(subject, 'El asunto es requerido');
            isValid = false;
        }
        
        // Validar mensaje
        if (!message.value.trim()) {
            showFieldError(message, 'El mensaje es requerido');
            isValid = false;
        }
        
        if (!isValid) {
            e.preventDefault();
        }
    });
    
    console.log('✓ Validación de formulario inicializada');
}

/**
 * Validar formato de email
 */
function isValidEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
}

/**
 * Mostrar error en campo
 */
function showFieldError(field, message) {
    field.style.borderColor = '#e74c3c';
    field.style.backgroundColor = '#ffe6e6';
    
    // Remover error después de 3 segundos
    setTimeout(() => {
        field.style.borderColor = '';
        field.style.backgroundColor = '';
    }, 3000);
}

/**
 * Scroll suave para enlaces internos
 */
function initSmoothScroll() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            const href = this.getAttribute('href');
            const element = document.querySelector(href);
            
            if (element) {
                e.preventDefault();
                element.scrollIntoView({ behavior: 'smooth' });
            }
        });
    });
}

/**
 * Utilidad: logger personalizado
 */
const logger = {
    info: (message) => console.log(`ℹ️ ${message}`),
    warn: (message) => console.warn(`⚠️ ${message}`),
    error: (message) => console.error(`❌ ${message}`),
    success: (message) => console.log(`✅ ${message}`)
};

/**
 * Utilidad: hacer solicitud AJAX
 */
async function fetchData(url, options = {}) {
    try {
        const response = await fetch(url, {
            headers: {
                'Content-Type': 'application/json',
                ...options.headers
            },
            ...options
        });
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return await response.json();
    } catch (error) {
        logger.error(`Error fetching ${url}: ${error.message}`);
        throw error;
    }
}

/**
 * Mostrar notificación
 */
function showNotification(message, type = 'info', duration = 3000) {
    const notification = document.createElement('div');
    notification.className = `notification notification-${type}`;
    notification.textContent = message;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        padding: 15px 20px;
        border-radius: 5px;
        z-index: 1000;
        animation: slideIn 0.3s ease-in-out;
    `;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, duration);
}

// Exportar para uso en otros archivos
window.SITE = SITE;
window.logger = logger;
window.fetchData = fetchData;
window.showNotification = showNotification;
