import { loadCSV, constructClients, constructWorkers } from './loadCSV.js';
import { buildAffectation } from './affectationBuilder.js';

import express from 'express';

const app = express();
const port = 3000;

// Middleware pour parser le JSON
app.use(express.json());

// Route simple
app.get('/pb_simple/:id', async (req, res) => {
  const id = req.params.id;
  res.send(await buildAffectation("pb_simple", id));
});

app.get('/pb_complexe/:id', async (req, res) => {
  const id = req.params.id;
  res.send(await buildAffectation("pb_complexe", id));
});

// Gestion des erreurs
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Une erreur est survenue !');
});

// Démarrer le serveur
app.listen(port, () => {
  console.log("Démarrage du serveur");
  buildAffectation("pb_simple", 1);
});
