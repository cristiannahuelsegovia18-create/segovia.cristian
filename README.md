<<<<<<< HEAD
# segovia.cristian
=======
# Proyecto Base

Estructura modular y escalable para proyectos.

## Estructura de Carpetas

```
proyecto/
├── src/                 # Código fuente principal
├── config/             # Archivos de configuración
├── tests/              # Pruebas unitarias
├── docs/               # Documentación
├── scripts/            # Scripts de utilidad
├── public/             # Archivos públicos/estáticos
├── .gitignore
├── .gitattributes
├── package.json
└── README.md
```

## Instalación

```bash
npm install
```

## Uso

```bash
npm start
```

## Pruebas

```bash
npm test
```

## Estructura de Configuración

- **config/index.js** - Configuración central
- **config/environment.js** - Gestión de variables de entorno
- **src/index.js** - Punto de entrada de la aplicación

## Quick Start

1) Preparar repositorio e instalar dependencias (recomendado):

```powershell
cd d:\segovia.cristian
bash ./init-git.sh
```

2) O ejecutar los pasos manualmente:

```powershell
cd d:\segovia.cristian
npm install
npm run setup
npm start
# o en desarrollo:
npm run dev
```

3) Si quieres iniciar el sitio web PHP (carpeta `web`):

```powershell
cd d:\segovia.cristian\web
php -S localhost:8000
```

4) Archivos importantes:

- Punto de entrada Node: `src/index.js`
- Sitio web (PHP): `web/index.php`

Si `npm` o `php` no están en tu PATH, instala Node.js (v18+) y PHP (7.4+) respectivamente.
>>>>>>> 6abb0e2 (Initial commit)
