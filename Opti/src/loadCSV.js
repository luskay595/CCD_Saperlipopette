import fs from "fs";
import { resourceUsage } from 'process';


/**
 * 
 * let clients = [];
 * let workers = [];
 * 
 * clients[i].needs = []
 * clients[i].name = "nom"
 * need = {}
 * need.type = ['BR','JD','MN','IF','AD']
 * 
 *  
 * workers[i].skills = [];
 * skill = {};
 * skill.preference = 5;
 * skill.type = ['BR','JD','MN','IF','AD']
 * 
 * let affectations = {};
 * affectation.workers = [];
 * affectation.clients = [];
 * affectation.tasks = [];
 * affectation
 * let task = {};
 * task.client;
 * task.worker;
 * task.score;
 */

export function loadCSV(filename) {
    const content = fs.readFileSync(filename, "utf8"); // Lire le fichier en UTF-8
    const lines = content.split("\n").map(line => line.trim()).filter(line => line); // Supprimer espaces vides et lignes vides

    let clients = [];
    let workers = [];
    let currentSection;

    for (let line of lines) {
        const values = line.split(";"); // Séparation des valeurs

        // Changement de section
        if (values[0] == "besoins") {
            currentSection = "clients";
        } else if (values[0] == "competences") {
            currentSection = "workers";
        } else {
            if (currentSection == "clients") {
                clients.push(values);
            }
            else if (currentSection == "workers") {
                workers.push(values)
            }
            else {
                console.log("Erreur de section");
            }
        }
    }
    let problem = {
        "clients": constructClients(clients),
        "workers": constructWorkers(workers)
    };

    return problem;
}

export function constructClients(rawClients) {
    var clients = [];
    console.log(rawClients);
    for (var rawClient in rawClients) {
        // Vérifier que le client n'est pas déjà dans la liste
        var inList = false;
        for (var i = 0; i < clients.length; i++) {
            if (clients[i]["name"] == rawClient[1]) {
                inList = true;
                clients[i].needs.push(rawClient[2]);
            }
        }
        if (!inList) {
            clients.push({ "name": rawClient[1], "needs": [rawClient[2]] });
        }
    }
    //console.log(clients)
    return clients;
}

export function constructWorkers(rawWorkers) {
    var workers = [];
    for (var rawWorker of rawWorkers) {
        // Vérifier que le client n'est pas déjà dans la liste
        var inList = false;
        for (var i = 0; i < workers.length; i++) {
            if (workers[i]["name"] == rawWorker[1]) {
                inList = true;
                workers[i].skills.push({ "type": rawWorker[2], "preference": rawWorker[3] });
            }
        }
        if (!inList) {
            workers.push({ "name": rawWorker[1], "skills": [{ "type": rawWorker[2], "preference": rawWorker[3] }] });
        }
    }
    return workers;
}
