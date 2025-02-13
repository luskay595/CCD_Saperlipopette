import fsAsynch from "fs/promises";
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
    for (var rawClient of rawClients) {
        // Vérifier que le client n'est pas déjà dans la liste
        var inList = false;
        let need = { "type": rawClient[2], isAffected: false };
        for (var i = 0; i < clients.length; i++) {
            if (clients[i]["name"] == rawClient[1]) {
                inList = true;
                clients[i].needs.push(need);
            }
        }
        if (!inList) {
            clients.push({ "name": rawClient[1], "needs": [need] });
        }
    }
    return clients;
}

export function constructWorkers(rawWorkers) {
    var workers = [];

    for (var rawWorker of rawWorkers) {
        // Vérifier que le travailleur n'est pas déjà dans la liste
        var inList = false;
        let type = rawWorker[2]
        let skillNote = rawWorker[3]
        let skill = {};
        skill[type] = parseInt(skillNote)


        for (var i = 0; i < workers.length; i++) {
            if (workers[i]["name"] == rawWorker[1]) {
                var inList = true;
                workers[i].skills[type] = skillNote;
            }
        }

        if (!inList) {
            let worker = { "name": rawWorker[1], "skills": { BR: 0, JD: 0, MN: 0, IF: 0, AD: 0 } };
            worker.skills[type] = skillNote
            workers.push(worker);
        }
    }
    return workers;
}

export async function findPath(categ, id) {
    let ident = id;
    if(ident == 0){
        ident = 1
    }
    let pathToData = "./data/";
    let categorie = "";

    switch (categ) {
        case "pb_simple":
            categorie = "01_pb_simples/"
            if(ident > 9){
                ident = 9
            }
            break;
        case "pb_complexe":
            categorie = "02_pb_complexes/"
            if(ident > 10){
                ident = 10
            }
            break;
        default:
            console.error("Invalide")
            break;
    }
    let pathToFiles = pathToData + categorie;


    // Lire les fichiers du répertoire

    // TEST
    try {
        const files = await fsAsynch.readdir(pathToFiles);


        let file = files.filter(f => !f.includes("Sol")).filter(f => f.includes("Probleme_" + id + "_"))

        return pathToFiles + file;
    } catch (error) {
        console.error(" Erreur lors de la lecture du répertoire :", error);
        return null;
    }
}
