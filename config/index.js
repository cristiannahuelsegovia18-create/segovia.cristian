/**
 * Configuración principal de la aplicación
 */

import environment from './environment.js';

const config = {
  app: {
    name: 'Proyecto Base',
    version: '1.0.0',
  },
  environment,
  debug: environment.DEBUG,
  port: environment.PORT,
};

export default config;
