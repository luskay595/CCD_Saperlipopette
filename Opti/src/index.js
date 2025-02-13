import { loadCSV, constructClients, constructWorkers } from './loadCSV.js';
import { buildAffectation } from './affectationBuilder.js';

import express from 'express';

const app = express();
const port = 3000;

// Middleware pour parser le JSON
app.use(express.json());

// Route simple
app.get('/', (req, res) => {
  res.send('Bienvenue sur mon API Express en JavaScript ! 🚀');
});

// Gestion des erreurs
app.use((err, req, res, next) => {
  console.error(err.stack);
  res.status(500).send('Une erreur est survenue !');
});

// Démarrer le serveur
app.listen(port, () => {
  console.log(`Serveur démarré sur http://localhost:${port}`);
  let res = buildAffectation("./data/01_pb_simples/Probleme_1_nbSalaries_3_nbClients_3_nbTaches_2.csv");
  //console.log(res);
});
