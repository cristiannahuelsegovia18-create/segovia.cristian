/**
 * Gestión de variables de entorno
 */

const getEnv = (key, defaultValue = null) => {
  const value = process.env[key];
  return value !== undefined ? value : defaultValue;
};

const environment = {
  NODE_ENV: getEnv('NODE_ENV', 'development'),
  PORT: parseInt(getEnv('PORT', '3000')),
  DEBUG: getEnv('DEBUG', 'false') === 'true',
};

export default environment;
