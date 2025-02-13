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

echo "🎉 Déploiement terminé avec succès !"
