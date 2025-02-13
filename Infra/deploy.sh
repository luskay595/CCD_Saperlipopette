#!/bin/bash

# Activer le mode strict pour éviter les erreurs silencieuses
set -e

echo "🚀 Déploiement en cours..."

# Étape 1: Se rendre dans le dossier Web et lancer docker compose
echo "🔄 Démarrage des services avec Docker Compose..."
cd ~/CCD_Saperlipopette/Web || { echo "❌ Erreur : Dossier Web introuvable !"; exit 1; }
docker compose up -d
echo "✅ Docker Compose lancé avec succès !"

# Étape 2: Arrêter et supprimer le conteneur existant "mon-projet" s'il tourne
echo "🛑 Arrêt de l'ancien conteneur mon-projet (s'il existe)..."
docker ps -q --filter "ancestor=mon-projet" | xargs -r docker stop || true
docker ps -a -q --filter "ancestor=mon-projet" | xargs -r docker rm || true
echo "✅ Ancien conteneur arrêté et supprimé !"

# Étape 3: Construire la nouvelle image Docker "mon-projet"
echo "🔨 Construction de l'image Docker mon-projet..."
cd ~/CCD_Saperlipopette/Opti || { echo "❌ Erreur : Dossier Opti introuvable !"; exit 1; }
docker build -t mon-projet .
echo "✅ Image Docker construite avec succès !"

# Étape 4: Démarrer le nouveau conteneur
echo "🚀 Démarrage du conteneur mon-projet..."
docker run -d -p 40027:3000 --name mon-projet mon-projet
echo "✅ Conteneur mon-projet lancé sur le port 40027 !"

# Étape 5: Récupérer dynamiquement les conteneurs d'API et s'y connecter
echo "🔍 Recherche des conteneurs API..."
API_CONTAINERS=$(docker ps --format "{{.Names}}" | grep "api_" || true)

if [ -n "$API_CONTAINERS" ]; then
  echo "🔌 Connexion aux conteneurs API..."
  for container in $API_CONTAINERS; do
    echo "📡 Tentative de connexion à $container..."
    docker exec -it -w / "$container" /bin/sh -c "echo '✅ Connecté à $container'" || echo "⚠️ Impossible de se connecter à $container, passage au suivant..."
  done
  echo "✅ Connexion aux conteneurs API terminée !"
else
  echo "⚠️ Aucun conteneur API trouvé !"
fi

# Étape 6: Suppression du dossier vendor et du fichier composer.lock puis réinstallation des dépendances
echo "🗑️ Suppression du dossier vendor et de composer.lock..."
cd ~/CCD_Saperlipopette/Opti || { echo "❌ Erreur : Dossier Opti introuvable !"; exit 1; }
rm -rf vendor composer.lock
echo "✅ Suppression effectuée !"

# Étape 7: Installation des dépendances Composer
echo "📦 Installation des dépendances Composer..."
if command -v composer &> /dev/null; then
  composer install
  echo "✅ Installation des dépendances terminée !"
else
  echo "⚠️ Composer introuvable ! Passage à l'étape suivante..."
fi

echo "🎉 Déploiement terminé avec succès !"
