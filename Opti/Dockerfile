# Utilisation de Node.js Alpine pour une image légère
FROM node:22-alpine

# Définition du répertoire de travail dans le conteneur
WORKDIR /app

# Copier package.json et package-lock.json pour optimiser le cache Docker
COPY package.json package-lock.json ./

# Installer uniquement les dépendances de production
RUN npm install --only=production

# Copier tout le code source et les fichiers de données dans l'image Docker
COPY src/ ./src/
COPY data/ ./data/

# Vérifier si index.js est bien copié (pour le debug)
RUN ls -lah /app/src

# Exposer le port utilisé par Express
EXPOSE 3000

# Démarrer l'application
CMD ["node", "src/index.js"]
