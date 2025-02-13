# Partie optimisation

## Réalisation : JUNG Damien (IL-2) LE NALINEC Tibère (IL-2) FROGER Corentin (IL-2) JEAN-BAPTISTE Evan (IL-2)

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


