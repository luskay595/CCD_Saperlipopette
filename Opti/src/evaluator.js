export function evaluate(affectation) {
    let score = 0;

    for (let i = 0; i < affectation.tasks.lenght; i++) {
        score += affectation.tasks[i].score;
    }

    for (let i = 0; i < affectation.clients.lenght; i++) {
        for (let j = 0; j < affectation.clients[i].lenght; j++) {
            if (affectation.clients[i].needs[j].isAffected != true) {
                score -= 10;
            }
        }
    }

    for (let i = 0; i < affectation.workers.lenght; i++) {
        if (affectation.workers[i].isAffected != true) {
            score -= 10;
        }
    }

    return score;
}