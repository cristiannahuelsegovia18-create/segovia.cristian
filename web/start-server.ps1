#!/usr/bin/env powershell
# Script para iniciar servidor PHP
# Uso: .\start-server.ps1

$webPath = "d:\segovia.cristian\web"
$port = 8000
$phpPath = "php"

Write-Host "🚀 Iniciando servidor PHP..." -ForegroundColor Green
Write-Host "📍 Ruta: $webPath" -ForegroundColor Cyan
Write-Host "🔌 Puerto: $port" -ForegroundColor Cyan
Write-Host "🌐 Acceso: http://localhost:$port" -ForegroundColor Yellow
Write-Host ""

# Verificar si PHP está instalado
try {
    $phpVersion = & $phpPath --version 2>&1
    Write-Host "✓ PHP encontrado: $phpVersion" -ForegroundColor Green
} catch {
    Write-Host "❌ PHP no está instalado o no se encuentra en el PATH" -ForegroundColor Red
    Write-Host "Por favor instala PHP desde: https://www.php.net/downloads" -ForegroundColor Yellow
    exit 1
}

# Iniciar servidor
Write-Host ""
Write-Host "Presiona Ctrl+C para detener el servidor" -ForegroundColor Yellow
Write-Host "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━" -ForegroundColor Gray
Write-Host ""

& $phpPath -S "localhost:$port" -t "$webPath"
