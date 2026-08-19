/**
 * GUÍA DE CONEXIÓN DE ARQUITECTURA
 * ================================
 * 
 * Este documento muestra cómo están conectados los módulos del proyecto.
 */

// ============================================
// 1. PUNTO DE ENTRADA: package.json
// ============================================
// {
//   "main": "src/index.js",
//   "scripts": {
//     "start": "node src/index.js",
//     "test": "node --test tests/**/*.js"
//   }
// }

// ============================================
// 2. INICIALIZACIÓN: src/index.js
// ============================================
// import config from '../config/index.js';
// import { loadModules } from './utils/index.js';
//
// initialize()
//   → carga configuración
//   → carga módulos
//   → inicia aplicación

// ============================================
// 3. CONFIGURACIÓN: config/
// ============================================
// config/
//   ├─ index.js (exporta config central)
//   │   └─ importa → environment.js
//   └─ environment.js
//       └─ lee variables de .env

// ============================================
// 4. UTILIDADES: src/utils/
// ============================================
// src/utils/index.js
//   ├─ loadModules() - Carga módulos
//   ├─ logger - Sistema de logging
//   └─ handleError - Manejo de errores

// ============================================
// 5. PRUEBAS: tests/
// ============================================
// tests/index.js
//   └─ Importa config y utils para testing
//   └─ Valida toda la estructura

// ============================================
// 6. CONFIGURACIÓN DEL SISTEMA: .env
// ============================================
// .env (variables de entorno)
//   ├─ NODE_ENV
//   ├─ PORT
//   └─ DEBUG

// ============================================
// FLUJO DE CONEXIÓN
// ============================================
//
//    package.json
//        ↓
//    npm start
//        ↓
//    src/index.js (punto de entrada)
//        ↓
//   ┌──────────────────────┐
//   ↓                      ↓
// config/index.js    src/utils/index.js
//   ↓                      ↓
// config/                logger
// environment.js      loadModules()
//   ↓                  handleError()
// .env
//
// ============================================

// ============================================
// ESTRUCTURA DE CARPETAS FINAL
// ============================================
//
// proyecto-base/
// │
// ├── 📂 src/                    (Código fuente)
// │   ├── index.js              (Punto de entrada)
// │   └── utils/
// │       └── index.js          (Funciones compartidas)
// │
// ├── 📂 config/                (Configuración)
// │   ├── index.js              (Config central)
// │   └── environment.js        (Variables de entorno)
// │
// ├── 📂 tests/                 (Pruebas)
// │   └── index.js              (Suite de pruebas)
// │
// ├── 📂 scripts/               (Scripts de utilidad)
// │   └── setup.js              (Configuración inicial)
// │
// ├── 📂 docs/                  (Documentación)
// │   └── PROJECT_STRUCTURE.md  (Este documento)
// │
// ├── 📂 public/                (Archivos estáticos)
// │
// ├── 📄 .env                   (Variables de entorno - ignorado en Git)
// ├── 📄 .env.example           (Template de .env)
// ├── 📄 .gitignore             (Archivos a ignorar)
// ├── 📄 .gitattributes         (Configuración de líneas)
// ├── 📄 package.json           (Dependencias)
// ├── 📄 README.md              (Documentación principal)
// ├── 📄 init-git.sh            (Script inicialización Git)
// └── 📄 ARCHITECTURE.md        (Este archivo)
//
// ============================================
// COMANDOS DISPONIBLES
// ============================================
// npm start      → Ejecutar aplicación
// npm run dev    → Ejecutar con watch
// npm test       → Ejecutar pruebas
// npm run setup  → Configuración inicial
//
// ============================================
