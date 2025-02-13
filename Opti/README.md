# Partie optimisation

### Réalisation : JUNG Damien (IL-2) LE NALINEC Tibère (IL-2) FROGER Corentin (IL-2) JEAN-BAPTISTE Evan (IL-2)

Concernant la partie optimisation, nous avons développe un serveur backend utilisant NodeJs.

Le problème est sélectionné à partir de l'url, par exemple : simple_pb/0 permet de récupérer le csv pour le premier problème simple, pb_complexe/3 le 3ème problème complexe, etc.

Ce fichier est ensuite lu et transformé en problème qui sera transmit à algorithme de résolution qui proposera une affectation, cette affectation sera évalué et un parser viendra transformer les résultats pour les transmettres.

