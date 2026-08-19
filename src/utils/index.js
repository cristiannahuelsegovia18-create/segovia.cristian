/**
 * Funciones utilitarias centrales
 */

/**
 * Carga los módulos de la aplicación
 * @returns {Promise<Array>} Array de módulos cargados
 */
export const loadModules = async () => {
  const modules = [
    'config',
    'utils',
    'core',
  ];
  
  return modules;
};

/**
 * Logger personalizado
 */
export const logger = {
  info: (message) => console.log(`ℹ️  ${message}`),
  warn: (message) => console.warn(`⚠️  ${message}`),
  error: (message) => console.error(`❌ ${message}`),
  success: (message) => console.log(`✅ ${message}`),
  debug: (message, data = null) => {
    if (process.env.DEBUG === 'true') {
      console.log(`🔍 ${message}`, data || '');
    }
  },
};

/**
 * Función helper para manejo de errores
 */
export const handleError = (error, context = '') => {
  logger.error(`${context}: ${error.message}`);
  if (process.env.DEBUG === 'true') {
    console.error(error.stack);
  }
};
