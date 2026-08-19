#!/bin/bash
# Script para inicializar Git y preparar el entorno de desarrollo
# Ejecutar desde PowerShell/WSL/GitBash: ./init-git.sh

set -e

echo "🔧 Iniciando inicialización del repositorio..."

# Inicializar repositorio Git si no existe
if [ ! -d .git ]; then
	git init
	echo "✅ Repositorio Git inicializado"
else
	echo "ℹ️  Repositorio Git ya existe"
fi

# Configurar usuario local (opcional)
# git config user.email "tu@email.com"
# git config user.name "Tu Nombre"

# Crear .env desde .env.example si no existe
if [ -f .env.example ] && [ ! -f .env ]; then
	cp .env.example .env
	echo "✅ Archivo .env creado desde .env.example"
elif [ -f .env ]; then
	echo "ℹ️  .env ya existe"
else
	echo "⚠️  No se encontró .env.example; omitiendo creación de .env"
fi

# Instalar dependencias Node si existe package.json
if [ -f package.json ]; then
	if command -v npm >/dev/null 2>&1; then
		echo "📦 Instalando dependencias Node (npm install)..."
		npm install
		echo "✅ Dependencias instaladas"
	else
		echo "⚠️  npm no encontrado. Instala Node.js y npm manualmente"
	fi

	# Ejecutar script de setup del proyecto si existe
	if npm run | grep -q "setup"; then
		echo "🔧 Ejecutando 'npm run setup'..."
		npm run setup
		echo "✅ Script de setup ejecutado"
	fi
fi

# Agregar todos los archivos y hacer commit inicial si no hay commits
if [ -z "$(git rev-parse --verify HEAD 2>/dev/null)" ]; then
	git add .
	git commit -m "Initial commit: Project structure and configuration"
	git branch -M main || true
	echo "✅ Commit inicial realizado"
else
	echo "ℹ️  El repositorio ya tiene commits; no se crea commit inicial"
fi

echo "✨ Inicialización completada"
