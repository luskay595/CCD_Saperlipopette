
/**
clients = [
    {"name" : "ALBERT", "needs" : {"type" : "BR", }]}
]

workers = [
    {"name" : "JEAN",
    "skills" : [{
        "type" : "AA",
        "preference" : 1
    },
    {"type" : "BA",
    "preference" : 3
    }]},
    {"name" : "JILLE",
    "skills" : {
        "BA" : 2,
        "AA" : 3
    }}
]
 */

export function solveBacktracking(workers, clients) {
    const affectation = {};
    affectation.workers = workers;
    affectation.clients = clients;
    affectation.tasks = [];

    let nbNeedMax = clients[0].needs.length;
    solving = true;

    // On cherche le nombre de besoins max
    for (let i = 1; i < clients.length; i++) {
        if (nbNeedMax < clients[i].needs.length)
            nbNeedMax = clients[i].needs.length;
    }

    for (let cycleCount = 0; cycleCount < nbNeedMax; cycleCount++) {
        for (let i = 0; i < clients.length; i++) {
            if (clients[i].needs.length <= nbNeedMax)
                continue;

            currentNeed = clients[i].needs[cycleCount];

            let worker = selectFreeWorker(workers, currentNeed.type);

            // post-traitement
            workers.remove(worker);
            currentNeed.isAffected = true;

            // creation de la tache 
            let task = {};
            task.worker = worker;
            task.need = currentNeed;
            task.client = clients[i];
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
