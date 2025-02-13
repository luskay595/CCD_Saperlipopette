import { evaluate } from "../evaluator.js";

/**
clients = [
    {"name" : "ALBERT", "needs" : [{"type" : "BR", "isAffected" : false}]]},
    {"name" : "JEAN", "needs" : [{"type" : "AA", "isAffected" : false}, {"type" : "BB", "affected" : false}]}
]

workers = [
    {"name" : "JEAN",
    "skills": { BR: 4, JD: 0, MN: 0, IF: 0, AD: 0 }},
    {"name" : "JILLE",
    "skills": { BR: 0, JD: 3, MN: 2, IF: 0, AD: 0 }}
]
 */

export function solveBacktracking(problem) {
    const affectation = {}
    // Travailleurs non-affectés
    affectation.workers = problem.workers
    affectation.clients = problem.clients
    affectation.tasks = []
    affectation.score = 0
    affectation.bestScore = 0
    affectation.count = 0

    return exploration(affectation);
}

/**
 * Fonction recusrvie d'exploration de l'arbre
 */
function exploration(affectation) {
    affectation.count++
    //Parcours de chaque enfant ; Un enfant = un worker associé à une need demandée par un client
    if (affectation.workers.length > 0) {
        //Récupération des actions a effectuer
        var actions = getActions(affectation)

        //Parcours des noeuds enfants
        for (var action of actions) {
            //Suppression du worker récupéré
            var i = 0;
            for (const worker of affectation.workers) {
                if (worker.name == action.worker.name) {
                    affectation.workers.splice(i, 1)
                }
                i++
            }
            //Le besoin du client est satisfait
            action.currentNeed.isAffected = true;

            //nouvelle tâche créée
            var task = { "worker": action.worker, "need": action.currentNeed, "client": action.client, "score": action.worker.skills[action.currentNeed.type] }
            affectation.tasks.push(task)

            //Récursivité
            exploration(affectation)

            //Choix du meilleur
            if (affectation.score > affectation.bestScore) {
                affectation.bestScore = affectation.score
            }
            else {
                //Si l'action n'est pas bonne on remet le worker et on enlève la tâche aujoutée et sa validation chez le client
                action.currentNeed.isAffected = false
                affectation.workers.push(action.worker)
                var i = 0
                for (const taskAffectation of affectation.tasks) {
                    if (taskAffectation.client.name == task.client.name && taskAffectation.need.type == task.need.type) {
                        affectation.tasks.splice(i, 1)
                    }
                    i++
                }
            }
        }
        return affectation
    }
    //S'il n'y a plus de worker, on évalue la liste des tâches 
    else {
        affectation.score = evaluate(affectation)
        return affectation
    }
}

/**
 * Prends l'état du problème actuel en paramètre
 * Renvoie la liste des actions possibles depuis un noeud [{"client":client1, "currentNeed":currentNeed1, "worker":worker1}, {name_cleint2, code, name_worker2}
 */
function getActions(affectation) {
    var actions = []
    for (var client of affectation.clients) {
        for (var need of client.needs) {
            if (need.isAffected == false) {
                for (var worker of affectation.workers) {
                    for (var keySkill in worker.skills) {
                        //Si le worker fait le travail et que son skill correspond au travail
                        if (worker.skills[keySkill] > 0 && keySkill == need.type) {
                            actions.push({ "client": client, "currentNeed": need, "worker": worker })
                        }
                    }
                }
            }
        }
    }
    return actions
}