/**
 * Punto de entrada de la aplicación
 */

import config from '../config/index.js';
import { loadModules } from './utils/index.js';

const initialize = async () => {
  console.log(`\n🚀 Iniciando ${config.app.name} v${config.app.version}`);
  console.log(`📍 Ambiente: ${config.environment.NODE_ENV}`);
  console.log(`🔧 Debug: ${config.debug}`);
  
  try {
    // Cargar módulos
    const modules = await loadModules();
    console.log(`✅ Módulos cargados: ${modules.length}`);
    
    console.log('\n✨ Aplicación iniciada correctamente\n');
  } catch (error) {
    console.error('❌ Error al iniciar la aplicación:', error);
    process.exit(1);
  }
};

initialize();
