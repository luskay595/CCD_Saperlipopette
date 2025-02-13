/**
 * Evalue une liste d'affectation
 * L'idée est que chaque 
 */
export function evaluate(affectation) {
    let score = 0;

    let clientsAlreadyHelped = {};

    for (let i = 0; i < affectation.tasks.length; i++) {
        let task = affectation.tasks[i];
        score += parseInt(task.score);
    }

    for (let i = 0; i < affectation.clients.length; i++) {
        clientsAlreadyHelped[affectation.clients[i].name] = 1
        for (let j = 0; j < affectation.clients[i].length; j++) {

            let need = affectation.clients[i].needs[j]
            if (need.isAffected != true) {
                score -= 10;
            }
            else
                clientsAlreadyHelped[affectation.clients[i].name] += 1
        }
    }

    for (let i = 0; i < affectation.workers.length; i++) {
        if (affectation.workers[i].isAffected != true) {
            score -= 10;
        }
    }

    for (let client of affectation.clients) {
        score = score - parseInt(clientsAlreadyHelped[client.name]) + 1
    }

    return score;
}