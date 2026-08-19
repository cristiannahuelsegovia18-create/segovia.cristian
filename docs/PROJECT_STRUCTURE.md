# Estructura del Proyecto

## Descripción de carpetas y archivos

### `/src`
Código fuente principal de la aplicación.
- `index.js` - Punto de entrada de la aplicación
- `utils/` - Funciones utilitarias compartidas

### `/config`
Archivos de configuración y variables de entorno.
- `index.js` - Configuración central exportada
- `environment.js` - Gestión de variables de entorno

### `/tests`
Suite de pruebas unitarias.
- `index.js` - Pruebas principales

### `/docs`
Documentación del proyecto.
- `PROJECT_STRUCTURE.md` - Este archivo

### `/scripts`
Scripts de utilidad del proyecto.
- `setup.js` - Script de configuración inicial

### `/public`
Archivos estáticos y públicos.

## Archivos de configuración

- `.gitignore` - Archivos a ignorar en Git
- `.gitattributes` - Configuración de líneas finales
- `package.json` - Dependencias y scripts del proyecto
- `README.md` - Documentación principal

## Flujo de conexión

```
package.json
    ↓
src/index.js
    ├→ config/index.js
    │   └→ config/environment.js
    └→ src/utils/index.js
        └→ loadModules()
```

## Scripts disponibles

- `npm start` - Ejecutar la aplicación
- `npm run dev` - Ejecutar en modo desarrollo (con watch)
- `npm test` - Ejecutar pruebas
- `npm run setup` - Configuración inicial
