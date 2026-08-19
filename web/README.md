# MotoHelm - Tienda de Cascos para Motocicleta

Sitio web de venta de cascos para motocicleta construido con HTML5, PHP y CSS3.

## Características

- ✅ Catálogo completo de cascos (6 modelos disponibles)
- ✅ Filtrado de productos por tipo
- ✅ Carrito de compras funcional
- ✅ Formulario de contacto con validación
- ✅ Información de productos detallada
- ✅ Responsive design (mobile, tablet, desktop)
- ✅ Información de envío y garantía
- ✅ Página de servicios
- ✅ Información de la tienda

## Páginas del Sitio

- **index.php** - Página principal con productos destacados
- **products.php** - Catálogo completo con filtros
- **about.php** - Información sobre MotoHelm
- **services.php** - Servicios: envío, garantía, cambios, asesoría
- **contact.php** - Formulario de contacto y consultas

## Productos Disponibles

1. **MotoHelm Pro Racing** - $299.99
   - Casco integral de máxima protección
   - Perfecto para carreras y alta velocidad

2. **MotoHelm Urban** - $149.99
   - Casco modular para uso urbano
   - Ideal para viajes ocasionales

3. **MotoHelm Off-Road** - $189.99
   - Casco de motocross
   - Máxima ventilación y protección facial

4. **MotoHelm Classic** - $179.99
   - Casco tipo jet abierto
   - Estilo vintage para scooters

5. **MotoHelm Cruiser** - $219.99
   - Casco abierto para cruisers
   - Cómodo para viajes largos

6. **MotoHelm Adventure** - $259.99
   - Casco modular adventure
   - Máxima versatilidad

## Servicios

- 🚚 Envío gratis en compras mayores a $150
- 🛡️ Garantía de 2 años
- 🔄 Cambio en 30 días sin preguntas
- 📞 Asesoría especializada
- 📚 Guía de mantenimiento incluida

## Contacto

- 📧 Email: ventas@motohelm.com
- ☎️ Teléfono: +57 (300) 123-4567
- 💬 WhatsApp: Disponible para asesoría al instante
- 📍 Dirección: Carrera 10 #45-50, Medellín, Colombia

## Características

### HTML5
- Estructura semántica válida
- Meta tags completos
- Viewport responsivo
- Fonts de Google

### PHP
- Gestión de configuración centralizada
- Funciones de seguridad (sanitización de inputs)
- Validación de formularios
- Gestión de sesiones
- Reutilización de código con includes

### CSS3
- Flexbox y Grid Layout
- Variables CSS
- Diseño responsive
- Animaciones suaves
- Media queries

### JavaScript
- Validación de formularios
- Manejo de eventos
- Scroll suave
- Funciones utilitarias
- Notificaciones

## Páginas

- **index.php** - Página principal con secciones de características
- **about.php** - Información sobre el sitio
- **services.php** - Servicios ofrecidos
- **contact.php** - Formulario de contacto con validación PHP

## Seguridad

- Sanitización de inputs
- Validación de emails
- Headers de seguridad
- CSRF protection ready
- Escapado de datos

## Ejecución

Requiere servidor PHP (Apache con mod_php o similar):

```bash
# Con PHP built-in
php -S localhost:8000 -t d:\segovia.cristian\web

# O con Apache
# Configurar DocumentRoot a d:\segovia.cristian\web
```

Acceder a: `http://localhost:8000`

## Archivos de configuración

### config.php
Contiene:
- Constantes de configuración
- Funciones de seguridad
- Funciones helpers
- Headers de seguridad

### Funciones disponibles
- `sanitizeInput()` - Limpiar entrada de usuario
- `isValidEmail()` - Validar email
- `getUrl()` - Obtener URL
- `showError()` - Mostrar errores en debug
