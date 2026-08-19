/**
 * Script de configuración inicial del proyecto
 */

import fs from 'fs';
import path from 'path';
import { fileURLToPath } from 'url';

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);
const projectRoot = path.join(__dirname, '..');

console.log('🔧 Configurando proyecto...\n');

// Crear archivo .env si no existe
const envPath = path.join(projectRoot, '.env');
if (!fs.existsSync(envPath)) {
  const envContent = `# Variables de entorno
NODE_ENV=development
PORT=3000
DEBUG=false
`;
  fs.writeFileSync(envPath, envContent);
  console.log('✅ Archivo .env creado');
} else {
  console.log('ℹ️  .env ya existe');
}

// Crear carpetas adicionales si no existen
const folders = ['logs', 'tmp', 'data'];
folders.forEach(folder => {
  const folderPath = path.join(projectRoot, folder);
  if (!fs.existsSync(folderPath)) {
    fs.mkdirSync(folderPath, { recursive: true });
    // Crear .gitkeep para mantener las carpetas en Git
    fs.writeFileSync(path.join(folderPath, '.gitkeep'), '');
    console.log(`✅ Carpeta ${folder}/ creada`);
  }
});

console.log('\n✨ Configuración completada\n');
