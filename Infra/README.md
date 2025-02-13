# Partie Infrastructure de Déploiement

Ce projet a été conçu et mis en place par **VANNESTE Lucas (DACS)**.

## 📌 Contexte et Choix Techniques

Initialement, nous avons voulu utiliser **Google Cloud Run** pour le déploiement. Cependant, Cloud Run ne prend pas en charge **Docker Compose**, ce qui nous a poussé à nous tourner vers **Docketu**.

Docketu nous permet d'exécuter des conteneurs Docker, mais impose des restrictions sur les commandes Docker exécutées en mode terminal non interactif. Cela a eu un impact sur notre gestion du déploiement via GitHub Actions, nous obligeant à trouver une solution alternative.

---

## 🚀 GitHub Actions - deploy.yml

Le fichier [`deploy.yml`](./deploy.yml) définit un workflow GitHub Actions qui automatise le déploiement à chaque **push** sur le dépôt.

### Étapes principales :
1. **Récupération du code** depuis le repository.
2. **Installation des dépendances** : `openconnect`, `sshpass` et `rsync`.
3. **Connexion au VPN AnyConnect** pour accéder au serveur distant.
4. **Synchronisation des fichiers** du dépôt vers le serveur via `rsync`.
5. **Déconnexion du VPN** une fois le déploiement terminé.

📄 [Voir le fichier deploy.yml](./deploy.yml)

---

## 📡 Surveillance et Déploiement Automatique sur Docketu

Docketu interdit l’exécution de commandes Docker en mode terminal non interactif, ce qui nous empêche de lancer directement les commandes Docker depuis GitHub Actions.

Pour contourner cette limitation, nous avons mis en place un **script de surveillance** [`watch_deploy.sh`](./watch_deploy.sh) qui tourne en arrière-plan sur le serveur et détecte les changements de fichiers.

### Fonctionnement de `watch_deploy.sh` :
1. Il surveille en continu le répertoire `/users/home/vanneste3u/CCD_Saperlipopette`.
2. Lorsqu'un fichier est modifié, il exécute **automatiquement** le script [`deploy.sh`](./deploy.sh).
3. `deploy.sh` assure le redémarrage des services en utilisant Docker Compose et reconstruit l’image `mon-projet` si nécessaire.

📄 [Voir le fichier watch_deploy.sh](./watch_deploy.sh)

---

## ⚙️ Script de Déploiement - deploy.sh

Le fichier [`deploy.sh`](./deploy.sh) est exécuté par `watch_deploy.sh` lorsqu'un changement est détecté.

### Étapes du déploiement :
1. **Démarrer Docker Compose** dans `CCD_Saperlipopette/Web`.
2. **Arrêter et supprimer l’ancien conteneur** de `mon-projet`.
3. **Construire une nouvelle image Docker** à partir des fichiers dans `CCD_Saperlipopette/Opti`.
4. **Démarrer le nouveau conteneur** sur le port `40027`.

📄 [Voir le fichier deploy.sh](./deploy.sh)

---

## 🎯 Conclusion

Nous avons donc une infrastructure qui combine **GitHub Actions** pour synchroniser les fichiers et **un script de surveillance sur Docketu** pour gérer le redéploiement automatique. Cette approche permet de contourner les restrictions de Docketu tout en gardant une certaine automatisation du processus.

Toute amélioration future pourrait inclure une solution de CI/CD alternative qui ne dépend pas de ces restrictions.

🚀 **Déploiement automatisé et fiable !**

