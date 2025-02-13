# Utilisation d'une image légère Node.js
FROM node:22-alpine

# Définition du répertoire de travail
WORKDIR /app

# Copier uniquement les fichiers nécessaires pour installer les dépendances
COPY package.json package-lock.json ./

# Installation des dépendances en mode production
RUN npm install --only=production

# Copier le reste des fichiers du projet
COPY . .

# Exposition du port utilisé par Express
EXPOSE 3000

# Démarrer l'application en précisant le bon chemin vers index.js
CMD ["node", "src/index.js"]
