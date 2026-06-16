#!/bin/bash
# StagesPro Cameroun – Script de déploiement one-click
# Usage: bash deploy.sh [environment]
# Requires: git, docker, docker-compose

set -e

ENV=${1:-production}
APP_DIR="/var/www/stagespro"
BRANCH="main"

echo "========================================"
echo "  StagesPro Cameroun – Déploiement"
echo "  Environnement : $ENV"
echo "========================================"

# 1. Pull latest code
echo "[1/7] Récupération du code..."
if [ -d "$APP_DIR" ]; then
  cd "$APP_DIR"
  git fetch origin $BRANCH
  git reset --hard origin/$BRANCH
else
  git clone https://github.com/stalker1709/hsv-stages.git "$APP_DIR"
  cd "$APP_DIR"
fi

# 2. Copy environment file
echo "[2/7] Configuration de l'environnement..."
if [ ! -f ".env" ]; then
  cp .env.example .env
  echo "  ⚠ Fichier .env créé — pensez à configurer vos variables !"
fi

# 3. Build and start containers
echo "[3/7] Construction des conteneurs Docker..."
cd "$APP_DIR/deploy"
docker-compose down --remove-orphans
docker-compose build --no-cache
docker-compose up -d

# Wait for DB to be ready
echo "[4/7] Attente de la base de données..."
sleep 10

# 4. Run migrations
echo "[5/7] Exécution des migrations..."
docker-compose exec -T app php artisan migrate --force

# 5. Seed database (first deploy only)
if [ "$2" == "--seed" ]; then
  echo "[5b] Initialisation des données de démonstration..."
  docker-compose exec -T app php artisan db:seed --force
fi

# 6. Clear and cache config
echo "[6/7] Optimisation de l'application..."
docker-compose exec -T app php artisan config:cache
docker-compose exec -T app php artisan route:cache
docker-compose exec -T app php artisan view:cache
docker-compose exec -T app php artisan storage:link

# 7. Done
echo "[7/7] Déploiement terminé !"
echo ""
echo "✅ StagesPro Cameroun est en ligne !"
echo "   URL : http://$(curl -s ifconfig.me 2>/dev/null || echo 'VOTRE_IP')"
echo ""
echo "Connexions de test :"
echo "  Stagiaire  : stagiaire@test.cm / password"
echo "  Encadreur  : encadreur@test.cm / password"
echo "  Admin      : admin@test.cm     / password"
