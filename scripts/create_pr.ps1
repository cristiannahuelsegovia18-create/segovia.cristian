# Script para crear rama, commitear y empujar cambios a remoto
# Uso: Ejecutar desde PowerShell en la raíz del proyecto (D:\segovia.cristian)

param(
    [string]$branch = "feat/ui-modern-palette",
    [string]$message = "Style: modern purple/cyan palette, modularize CSS, typography & layout improvements"
)

Write-Host "Comprobando git..." -ForegroundColor Cyan
try {
    $gitVersion = git --version 2>&1
    Write-Host "Git encontrado: $gitVersion" -ForegroundColor Green
} catch {
    Write-Host "ERROR: Git no está instalado o no está en el PATH. Instálalo y vuélvelo a intentar." -ForegroundColor Red
    exit 1
}

# Cambiar a la ruta del repo
$repoPath = Resolve-Path ".." -Relative | ForEach-Object { Join-Path (Get-Location) $_ }
# (Se asume que se ejecuta desde scripts/) - si no, el usuario puede ejecutar desde la raíz

Write-Host "Creando y cambiando a la rama: $branch" -ForegroundColor Cyan
git checkout -b $branch

Write-Host "Añadiendo archivos modificados..." -ForegroundColor Cyan
git add web/css/base.css web/css/components.css web/css/layout.css web/css/utilities.css web/css/shop.css web/css/styles.css web/index.html

Write-Host "Haciendo commit..." -ForegroundColor Cyan
git commit -m "$message"

Write-Host "Empujando la rama al remoto (origin)..." -ForegroundColor Cyan
git push -u origin $branch

Write-Host "Hecho. Ahora puedes abrir un pull request desde tu proveedor (GitHub/GitLab)." -ForegroundColor Green

# Intentar abrir la url del PR (solo si GitHub y 'git remote' responde con origin HTTPS)
try {
    $remote = git remote get-url origin 2>$null
    if ($remote) {
        if ($remote -match "github.com[:/](.+)/(.+)(\.git)?$") {
            $owner = $matches[1]
            $repo = $matches[2]
            $prUrl = "https://github.com/$owner/$repo/compare/$branch?expand=1"
            Write-Host "Abriendo PR en: $prUrl" -ForegroundColor Cyan
            Start-Process $prUrl
        }
    }
} catch {
    # ignore
}
