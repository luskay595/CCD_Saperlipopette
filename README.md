# Dépôt du projet de l'équipe Saperlipopette #

## Liste des membres ##

 - DIRAND / Félicien / RA-DWM1
 - GEORGES / Vincent / RA-DWM2
 - VANNESTE / Lucas / DACS
 - LE NALINEC / Tibère / RA-IL2
 - FROGER / Corentin / RA-IL2
 - JUNG / Damien / RA-IL2
 - JEAN-BAPTISTE / Evan / RA-IL2

## URL ##

- [Lien vers le dépôt](https://github.com/Jean-BaptisteEvan/CCD_Saperlipopette)
    - [Lien vers le fork](https://github.com/luskay595/CCD_Saperlipopette)
- [Lien vers l'API back partie web](http://docketu.iutnc.univ-lorraine.fr:40016/besoins/1)
- [Lien vers l'API back partie opti](http://docketu.iutnc.univ-lorraine.fr:40027/pb_complexe/7)
- [Lien avec l'API client](http://docketu.iutnc.univ-lorraine.fr:40014/)
- [Lien vers l'API de gestion de bd](http://docketu.iutnc.univ-lorraine.fr:40026/)
- [Lien avec l'API front web](http://docketu.iutnc.univ-lorraine.fr:40025/)

##  Partie application Web ##

### Liste des numéros de fonctionnalités implantées ###

- Création d'un besoin
- Affichage de la liste de tous les besoins

##  Partie Optimisation ##

Concernant la partie optimisation, nous avons développe un serveur backend utilisant NodeJs.

Nous avons fait le choix (malheureux) de tout coder avec Javascript. Nous avons rencontrer de nombreux problèmes et cela nous a beaucoup ralenti dans notre codage.

### Fonctionnement de du backend

Le problème est sélectionné à partir de l'url, par exemple : simple_pb/0 permet de récupérer le csv pour le premier problème simple, pb_complexe/3 le 3ème problème complexe, etc.

Ce fichier est ensuite lu et transformé en problème qui sera transmit à algorithme de résolution qui proposera une affectation, cette affectation sera évalué et un parser viendra transformer les résultats pour les transmettres.

### Fonctionnalités développées

Nous avons donc développé :
    - Fonctions de lecture de fichiers CSV qui converti les données CSV en données pratiques à utiliser après
    - Fonction d'écriture de fichier CSV pour convertir nos résultats de résolution de problèmes en CSV
    - Fonction qui récupère le bon fichier CSV grâce à l'URL
    - Fonction de résolution du problème 
    - Fonction d'évaluation de la solution

### Algortihme Glouton
Nous avons totallement implémenté un algorithme glouton qui hierarchise les besoins.
Il fonction selon la logique suivante :
*** 
    - On récupère le nombre maximum de besoin clients
    - De 0 au nombre maximum de besoin de clients
        - Pour chaque clients 
            - Trouver le travailleur qui répond le mieux au besoin étudié 
***
De cette manière on évalue toujours (enfin on essaye) au moins 1 besoin par client ce qui nous limite le malus associé.
Cette algorithme n'est pas optimal, car si on épuise tout nos travailleurs compétent dans 2 domaines sur le domaine A et qu'il ne nous reste que des travailleurs compétent dans le domaine A et des tâches pour le domaine B, alors cet algorithme sera catastrophique.

### Algorithme de Backtracking
Après la moitié de la journée, nous avons commencé à implémenter un algorithme de backtracking.
Notre algortihme de backtracking était sensé parcourir tout l'arbre (toutes les branches et tout les noeuds) afin de trouver la meilleure solution.
Nous n'avons malheureusement pas réussi à tester le backtracking suite à de nombreux problèmes.
Nous n'avons pas eu le temps de les <sub>résoudre.</sub>

##  Déploiement ##

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

