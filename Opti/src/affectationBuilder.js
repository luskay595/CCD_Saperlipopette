import { loadCSV } from "./loadCSV.js";
import { solveGlouton } from "./problemSolvers/solveGlouton.js";
import { evaluate } from "./evaluator.js";

export function buildAffectation(path) {
    let problem = loadCSV(path)
    let affectation = solveGlouton(problem);
    let score = evaluate(affectation);


}
