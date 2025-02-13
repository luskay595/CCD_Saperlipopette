#!/bin/bash

WATCH_DIR="/users/home/vanneste3u/CCD_Saperlipopette"
DEPLOY_SCRIPT="$WATCH_DIR/deploy.sh"

echo "📡 Surveillance des changements dans $WATCH_DIR..."
LAST_STATE=$(ls -lR "$WATCH_DIR")

while true; do
  sleep 5  # Vérifie toutes les 5 secondes
  CURRENT_STATE=$(ls -lR "$WATCH_DIR")

  if [[ "$LAST_STATE" != "$CURRENT_STATE" ]]; then
    echo "📦 Changement détecté ! Exécution de deploy.sh..."
    bash "$DEPLOY_SCRIPT"
    LAST_STATE="$CURRENT_STATE"
  fi
done