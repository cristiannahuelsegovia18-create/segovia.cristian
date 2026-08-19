/**
 * Suite de pruebas principal
 */

import { test } from 'node:test';
import assert from 'node:assert';
import config from '../config/index.js';
import { loadModules, logger } from '../src/utils/index.js';

test('Configuración debe estar definida', () => {
  assert.ok(config, 'Config debe existir');
  assert.strictEqual(config.app.name, 'Proyecto Base');
});

test('Variables de entorno deben cargarse correctamente', () => {
  assert.ok(config.environment.NODE_ENV);
  assert.ok(typeof config.environment.PORT === 'number');
});

test('Módulos deben cargarse sin errores', async () => {
  const modules = await loadModules();
  assert.ok(Array.isArray(modules), 'loadModules debe retornar un array');
  assert.ok(modules.length > 0, 'Debe haber módulos cargados');
});

test('Logger debe tener todos los métodos', () => {
  assert.strictEqual(typeof logger.info, 'function');
  assert.strictEqual(typeof logger.warn, 'function');
  assert.strictEqual(typeof logger.error, 'function');
  assert.strictEqual(typeof logger.success, 'function');
  assert.strictEqual(typeof logger.debug, 'function');
});
