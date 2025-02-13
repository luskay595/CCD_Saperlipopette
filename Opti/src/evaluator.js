/**
 * Evalue une liste d'affectation
 * L'idée est que chaque 
 */
export function evaluate(affectation) {
    let score = 0;

    for (let i = 0; i < affectation.tasks.length; i++) {
        score += parseInt(affectation.tasks[i].score);
    }

    for (let i = 0; i < affectation.clients.length; i++) {
        for (let j = 0; j < affectation.clients[i].length; j++) {
            if (affectation.clients[i].needs[j].isAffected != true) {
                score -= 10;
            }
        }
    }

    for (let i = 0; i < affectation.workers.length; i++) {
        if (affectation.workers[i].isAffected != true) {
            score -= 10;
        }
    }

    return score;
}