import { loadCSV, findPath } from "./loadCSV.js";
import { solveGlouton } from "./problemSolvers/solveGlouton.js";
import { solveBacktracking } from "./problemSolvers/solveBacktracking.js";
import { evaluate } from "./evaluator.js";
import { exportAffectationToString, exportAffectationToCSV } from "./affectationParser.js";

export async function buildAffectation(categ, id) {
    let path = await findPath(categ, id)

    let problem = loadCSV(path)
    let affectation = solveGlouton(problem)
    let score = evaluate(affectation)

    let fileContent = exportAffectationToString(affectation, score)

    let file = exportAffectationToCSV("./test.csv", affectation, score)

    return fileContent
}
