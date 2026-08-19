<#
.SYNOPSIS
  Inicializa el entorno de desarrollo en Windows (PowerShell).

.DESCRIPTION
  Comprueba la presencia de Node/npm y PHP, crea .env desde .env.example si hace falta,
  instala dependencias Node y ejecuta el script de setup. Opcionalmente puede arrancar
  la aplicación Node y/o el servidor PHP.

.EXAMPLE
  .\init-environment.ps1
  Ejecuta las comprobaciones y la instalación (no inicia servidores).

.EXAMPLE
  .\init-environment.ps1 -StartNode
  Instala dependencias y arranca la app Node con `npm start`.

.EXAMPLE
  .\init-environment.ps1 -StartPHP
  Instala dependencias y arranca el servidor PHP integrado en la carpeta `web`.
#>

param(
  [switch]$StartNode,
  [switch]$StartPHP
)

function Test-CommandAvailable {
  param([string]$cmd)
  $c = Get-Command $cmd -ErrorAction SilentlyContinue
  return $null -ne $c
}

Write-Host "[INFO] Comprobando entorno en: $PWD" -ForegroundColor Cyan

# Crear .env desde .env.example si es necesario
if (Test-Path ".env.example") {
  if (-not (Test-Path ".env")) {
    Copy-Item ".env.example" ".env"
    Write-Host "[OK] Archivo .env creado desde .env.example"
  }
  else { Write-Host "[INFO] .env ya existe; omitiendo creación" }
} else {
  Write-Host "⚠️  No se encontró .env.example en el directorio actual" -ForegroundColor Yellow
}

$nodeAvailable = Test-CommandAvailable node
$npmAvailable = Test-CommandAvailable npm
if (-not $nodeAvailable -or -not $npmAvailable) {
  Write-Host "[WARN] Node.js o npm no están instalados o no están en PATH." -ForegroundColor Yellow
} else {
  $nodeV = (& node --version) 2>$null
  $npmV = (& npm --version) 2>$null
  Write-Host "[OK] Node y npm detectados: $nodeV / npm $npmV" -ForegroundColor Green
}

# Instalar dependencias si es posible
if ($npmAvailable) {
  Write-Host "[ACTION] Instalando dependencias (npm install)..." -ForegroundColor Cyan
  npm install
  # Ejecutar setup si existe
  $runs = npm run 2>$null | Out-String
  if ($runs -match 'setup') {
    Write-Host "[ACTION] Ejecutando npm run setup..." -ForegroundColor Cyan
    npm run setup
  }
} else {
  Write-Host "⚠️  npm no disponible: omitiendo instalación automática de dependencias." -ForegroundColor Yellow
}

# Ejecutar init-git.sh si bash está disponible
if (Test-Path "init-git.sh") {
  if (Test-CommandAvailable bash) {
    Write-Host "[ACTION] Ejecutando init-git.sh con bash..." -ForegroundColor Cyan
    & bash ./init-git.sh
  } else {
    Write-Host "[INFO] bash no disponible; init-git.sh no se ejecutó" -ForegroundColor Cyan
  }
}

if ($StartNode) {
  if ($npmAvailable) {
    Write-Host "[START] Iniciando aplicación Node (npm start)..." -ForegroundColor Cyan
    Start-Process npm -ArgumentList 'start' -NoNewWindow
  } else {
    Write-Host "[WARN] npm no disponible: no puedo iniciar la app Node." -ForegroundColor Yellow
  }
}

if ($StartPHP) {
  if (Test-CommandAvailable php) {
    if (Test-Path "web") {
      Write-Host "[START] Iniciando servidor PHP en http://localhost:8000 (carpeta web)" -ForegroundColor Cyan
      Push-Location web
      Start-Process php -ArgumentList '-S','localhost:8000' -NoNewWindow
      Pop-Location
    } else {
      Write-Host "[WARN] No se encontró la carpeta 'web'" -ForegroundColor Yellow
    }
  } else {
    Write-Host "[WARN] PHP no está instalado o no está en PATH." -ForegroundColor Yellow
  }
}

Write-Host "`n[DONE] init-environment.ps1 finalizado." -ForegroundColor Green
