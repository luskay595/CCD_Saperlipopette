# Utilisation de l'image Node.js alpine pour une légèreté optimale
FROM node:22-alpine

# Définition du répertoire de travail
WORKDIR /app

# Copie des fichiers package.json et package-lock.json avant installation des dépendances
COPY package.json package-lock.json ./

# Installation des dépendances
RUN npm install --only=production

# Copie du reste des fichiers dans l'image
COPY . .

# Exposition du port 3000 pour l'application Express
EXPOSE 3000

# Commande pour exécuter l'application
CMD ["node", "index.js"]
