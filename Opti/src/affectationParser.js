// import { parse } from "papaparse";

/**
 *  let affectations = {};
 * affectation.workers = [];
 * affectation.clients = [];
 * affectation.tasks = [];
 * affectation
 * let task = {};
 * task.besoin.need.type
 * task.client;
 * task.worker;
 * task.score;
 */

export function exportAffectationToString(affectation, score) {
    let string = score + ";\n";

    for (const task of affectation.tasks) {
        string += task.worker.name + ";" + task.need.type + ";" + task.client.name + ";\n";
    }

    return string
}

export function exportAffectationToCSV(filename, affectation, score) {
    let csvContent = exportAffectationToString(affectation, score);

    // Écrire dans le fichier
    fs.writeFileSync(filename + ".csv", csvContent, "utf8");
    return fs
}
