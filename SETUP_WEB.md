# Instrucciones para ejecutar MotoHelm - Tienda de Cascos

## Requisitos

- **PHP 7.4 o superior**
- **Servidor web** (Apache, Nginx) o usar el servidor built-in de PHP

## Opción 1: Usar PHP Built-in Server (Recomendado para desarrollo)

### Windows (PowerShell)

```powershell
cd d:\segovia.cristian\web
php -S localhost:8000
```

O ejecutar el script:

```powershell
.\start-server.ps1
```

### Linux/Mac

```bash
cd d:\segovia.cristian\web
php -S localhost:8000
```

Luego acceder a: **http://localhost:8000**

## Opción 2: Usar Apache

1. Configurar DocumentRoot en `httpd.conf`:
```apache
DocumentRoot "d:\segovia.cristian\web"
```

2. Reiniciar Apache
3. Acceder a: **http://localhost**

## Opción 3: Usar Docker

```dockerfile
FROM php:8.0-apache

COPY ./web /var/www/html

EXPOSE 80
```

Ejecutar:
```bash
docker build -t mi-sitio .
docker run -p 8000:80 mi-sitio
```

## Estructura de URLs

Una vez ejecutando el servidor:

- `http://localhost:8000` → Página principal con productos destacados
- `http://localhost:8000/products.php` → Catálogo completo de cascos
- `http://localhost:8000/about.php` → Acerca de MotoHelm
- `http://localhost:8000/services.php` → Servicios: envío, garantía, asesoría
- `http://localhost:8000/contact.php` → Contacto: formulario y datos

## Archivos importantes

### Punto de entrada
- **index.php** - Página principal del sitio

### Componentes reutilizables (PHP Includes)
- **includes/config.php** - Configuración centralizada
- **includes/header.php** - Encabezado HTML (se carga en todas las páginas)
- **includes/footer.php** - Pie de página (se carga en todas las páginas)

### Estilos
- **css/styles.css** - Todos los estilos CSS del sitio

### JavaScript
- **js/main.js** - Funcionalidades JavaScript

## Cómo funciona

1. Cada página PHP (`index.php`, `contact.php`, etc.) incluye `includes/header.php` al inicio
2. El header.php incluye `includes/config.php` para la configuración
3. Al final de cada página se incluye `includes/footer.php`
4. Los estilos CSS y JavaScript se cargan automáticamente desde header.php

## Funcionalidades implementadas

✅ HTML5 semántico
✅ Formulario de contacto con validación PHP
✅ Sanitización de inputs
✅ Validación de emails
✅ Diseño responsive (funciona en mobile, tablet y desktop)
✅ Animaciones CSS
✅ JavaScript para interactividad
✅ Sistema de alertas
✅ Navegación completa

## Seguridad

El sitio implementa:
- Sanitización de inputs (eliminación de HTML/JavaScript)
- Validación de email
- Headers de seguridad HTTP
- Escapado de caracteres especiales

## Próximos pasos

Para mejorar el sitio puedes:

1. **Agregar base de datos**: Conectar MySQL/PostgreSQL
2. **Sistema de comentarios**: Implementar comentarios en posts
3. **Autenticación**: Agregar login/registro de usuarios
4. **Panel admin**: Crear dashboard para gestionar contenido
5. **API REST**: Convertir a API para aplicaciones móviles
6. **Email**: Configurar envío real de emails (usar PHPMailer)
7. **SEO**: Optimizar metadatos y estructura
8. **Cache**: Implementar sistema de cache

## Troubleshooting

**Error: "php is not recognized"**
- PHP no está en el PATH. Instálalo desde https://www.php.net/downloads
- O especifica la ruta completa: `C:\php\php.exe -S localhost:8000`

**Error: "Port already in use"**
- Usa otro puerto: `php -S localhost:8001`

**Error: "Class not found" o "Function undefined"**
- Verifica que todos los archivos PHP estén en las carpetas correctas
- Revisa los paths en los `require_once` statements

**Sitio no carga estilos**
- Asegúrate que los paths en CSS y JS sean correctos
- Los paths son relativos a la raíz (carpeta `web`)
