# 🏍️ MotoHelm - Tienda Online de Cascos para Motocicleta

Sitio web completo de comercio electrónico para la venta de cascos de motocicleta. Construido con HTML5, PHP y CSS3 responsive.

## ✨ Características Principales

### Catálogo de Productos
- 6 modelos diferentes de cascos
- Información detallada de cada producto
- Múltiples colores disponibles
- Características específicas por modelo
- Precios competitivos

### Tipos de Cascos Disponibles
- **Integral**: Máxima protección para carreras y alta velocidad
- **Modular**: Versatilidad para uso urbano
- **Motocross**: Ventilación óptima para deportes extremos
- **Jet/Abierto**: Estilo clásico para scooters
- **Adventure**: Diseño versátil para viajes

### Funcionalidades

✅ **Sistema de Filtrado**
- Filtrar por tipo de casco
- Búsqueda intuitiva
- Interfaz amigable

✅ **Carrito de Compras**
- Agregar productos al carrito
- Sistema simulado (preparado para integración real)

✅ **Información de Compra**
- Múltiples opciones de pago
- Información de envío
- Garantía de 2 años
- Cambios en 30 días

✅ **Contacto y Asesoría**
- Formulario de contacto completo
- Múltiples canales: email, teléfono, WhatsApp
- Temas específicos de consulta
- Validación de formularios

✅ **Información de la Tienda**
- Historia y misión de MotoHelm
- Valores y compromisos
- Datos de contacto
- Dirección física

### Seguridad

- Sanitización de inputs
- Validación de emails
- Prevención de inyección HTML/JavaScript
- Headers de seguridad HTTP
- Escapado de caracteres especiales

## 📁 Estructura de Archivos

```
web/
├── index.php                 # Página principal
├── products.php             # Catálogo de cascos
├── about.php                # Información de la tienda
├── services.php             # Servicios y garantías
├── contact.php              # Formulario de contacto
├── includes/
│   ├── config.php          # Configuración y funciones
│   ├── header.php          # Encabezado HTML
│   └── footer.php          # Pie de página
├── css/
│   └── styles.css          # Estilos CSS responsive
├── js/
│   └── main.js             # JavaScript interactivo
├── images/                 # Imágenes del sitio
└── README.md               # Documentación
```

## 🚀 Instalación y Uso

### Requisitos
- PHP 7.4 o superior
- Navegador moderno

### Inicio Rápido

**1. Con PHP Built-in Server:**
```bash
cd d:\segovia.cristian\web
php -S localhost:8000
```

**2. Con PowerShell Script:**
```powershell
.\start-server.ps1
```

**3. Acceder al sitio:**
```
http://localhost:8000
```

## 📋 Guía de Uso

### Página Principal (index.php)
- Muestra 3 cascos destacados
- Información de por qué elegir MotoHelm
- Llamada a la acción para ver catálogo

### Catálogo (products.php)
- Vista de 6 cascos disponibles
- Filtros por tipo
- Información completa de cada casco
- Botón para agregar al carrito
- Información de garantía

### Acerca de (about.php)
- Historia de MotoHelm
- Misión y visión
- Valores de la empresa
- Por qué somos diferentes

### Servicios (services.php)
- Envío rápido y gratuito
- Opciones de pago
- Garantía 2 años
- Cambios sin costo
- Asesoría especializada
- Guía de mantenimiento

### Contacto (contact.php)
- Formulario con validación
- Campo de teléfono/WhatsApp
- Selector de temas de consulta
- Información de contacto directa
- Links a WhatsApp

## 💳 Formas de Compra

1. **Tienda en Línea** - 24/7 disponible
2. **Por Teléfono** - +57 (300) 123-4567
3. **WhatsApp** - Chat directo
4. **Tienda Física** - Carrera 10 #45-50, Medellín

## 🛡️ Garantías y Políticas

### Garantía
- 2 años de cobertura completa
- Contra defectos de fabricación
- Reemplazo gratuito

### Cambios
- 30 días para cambiar sin preguntas
- Reembolso completo
- O cambio a otro modelo

### Envío
- Entrega en 2-5 días hábiles
- Gratis en compras mayores a $150
- Rastreo en tiempo real
- Empaques protegidos

## 🎨 Diseño y Experiencia

- **Responsive**: Funciona en móvil, tablet y desktop
- **Moderno**: Diseño limpio y profesional
- **Rápido**: Carga optimizada
- **Accesible**: Navegación intuitiva
- **Seguro**: Validación en cliente y servidor

## 📱 Compatibilidad

- Chrome, Firefox, Safari, Edge
- iOS y Android
- Tablets y dispositivos móviles
- Resoluciones desde 320px hasta 4K

## 🔧 Funciones PHP Principales

```php
// Configuración
SITE_NAME = 'MotoHelm - Cascos para Motocicleta'
SITE_VERSION = '1.0.0'
STORE_SLOGAN = 'Protege tu vida, elige MotoHelm'

// Funciones
sanitizeInput()        // Limpia entrada de usuario
isValidEmail()         // Valida formato de email
getUrl()              // Obtiene URL relativa
```

## 📊 Datos de Productos

**6 Modelos Disponibles:**

1. Pro Racing - $299.99 (Integral)
2. Urban - $149.99 (Modular)
3. Off-Road - $189.99 (Motocross)
4. Classic - $179.99 (Jet)
5. Cruiser - $219.99 (Abierto)
6. Adventure - $259.99 (Adventure)

## 🌟 Próximos Pasos para Mejora

- [ ] Integrar carrito de compras real (sesiones PHP)
- [ ] Base de datos (MySQL) para gestionar productos
- [ ] Sistema de usuarios y login
- [ ] Integración de pasarelas de pago (PayPal, Stripe)
- [ ] Envío de emails (PHPMailer)
- [ ] Panel de administración
- [ ] Sistema de reviews/comentarios
- [ ] Blog con artículos sobre cascos
- [ ] API REST para aplicaciones móviles
- [ ] Analytics e integración con Google

## 📞 Contacto de Soporte

- **Email**: ventas@motohelm.com
- **Teléfono**: +57 (300) 123-4567
- **WhatsApp**: Chat directo desde el sitio
- **Ubicación**: Medellín, Colombia

## 📄 Licencia

Este proyecto es un ejemplo educativo para demostrar desarrollo web con HTML5, PHP y CSS3.

---

**MotoHelm** - *Protege tu vida, elige MotoHelm* 🏍️
