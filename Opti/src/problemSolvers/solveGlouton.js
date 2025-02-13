
/**
 * Regle 1 (duree d une tache) : les besoins proposes par les clients prennent exactement
une journee pour etre realises et ne necessitent qu une seule competence.

Regle 2a (journee de travail) : un salarie ne peut travailler que sur un seul besoin pendant
une journee.

Regle 2b (besoin mono-tache) : de maniere similaire, un besoin ne peut etre effectue
qu une seule fois par journee et affecte qu a un seul salarie.

Regle 3 (competence necessaire) : un salarie ne peut etre affecte qu a un besoin pour
lequel il dispose de la competence requise.

Regle 4 (gain lie a l interet pour la tache) : chaque affectation d un salarie a un besoin
rapporte a l affectation un nombre de points lie a l interet que le salarie a pour le type du
besoin. Ainsi, si Delphine est affectee a un besoin de jardinage pour lequel elle a emis un
interet personnel de 8, cette partie de l affectation rapportera 8 points au score de
l affectation globale.
 */

export function solveGlouton(problem) {
    const affectation = {};
    // Travailleurs non-affectés
    affectation.workers = problem.workers;
    // Clients
    affectation.clients = problem.clients;
    affectation.tasks = [];

    //console.log(problem.clients);
    let nbNeedMax = problem.clients[0].needs.length;
    let solving = true;

    // On cherche le nombre de besoins max
    for (let i = 1; i < problem.clients.length; i++) {
        if (nbNeedMax < problem.clients[i].needs.length)
            nbNeedMax = problem.clients[i].needs.length;
    }

    for (let cycleCount = 0; cycleCount < nbNeedMax; cycleCount++) {
        for (let i = 0; i < problem.clients.length; i++) { // clients undefined
            if (problem.clients[i].needs.length <= nbNeedMax)
                continue;

            currentNeed = problem.clients[i].needs[cycleCount];

            let worker = selectFreeWorker(problem.workers, currentNeed.type);

            // post-traitement
            problem.workers.remove(worker);
            currentNeed.isAffected = true;

            // creation de la tache 
            let task = {};
            task.worker = worker;
            task.need = currentNeed;
            task.client = problem.clients[i];
            task.score = worker.preference[currentNeed.type];

            affectation.tasks.add(task);
        }
    }
    return affectation;
}

/**
 * Selectionne un travailleur disponible selon un type recherche
 */
function selectFreeWorker(freeWorkers, searchedType) {
    currentWorker = {};

    // On selectionne le meilleur travailleur,
    for (let w = 0; w < freeWorkers.length; w++) {
        if (currentWorker == {} || isWorkerValid(freeWorkers[i], searchedType, currentWorker.skills[searchedType].preference)) {
            currentWorker = freeWorkers[w];
        }
    }

    // On marque le travailleur comme affecte
    currentWorker.isAffected = true;
    return currentWorker;
}

/**
 * Verifie si le travailleur est bien valide pour la tache demandee
 * worker       : le travailleur dont il est question
 * searchedType : type de travaille voulu
 * skillPref    : type de travaille prefere
 */
function isWorkerValid(worker, searchedType, skillPref) {
    // On verifie si le travailleur possede le type recherche
    // S'il n est pas deja affecte,
    // skillPref < worker.skills[searchedType]
    return worker.skills[searchedType] && !worker.isAffected && skillPref < worker.skills[searchedType]
}
