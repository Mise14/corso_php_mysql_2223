
// copia 
const persona = {
    nome:"Mario",
    cognome : "Rossi"
}

const persona_copy = {...persona}

// console.log(persona_copy)

// merge object

const voti = {
    "materia":"MAT",
    "voti":[5,5,6,7,2]
}

const studente = {...persona,...voti}

// console.log(studente)

const luigi = {
    nome:"Luigi",
   
}

const luigi_studente = {...persona,...luigi,...voti}

// console.log(luigi_studente)
const newTask = { 
    name:"   Rinnovare patente       ",   
    user_id :12,
    due_date : "2000-03-01"
}
const senza_spazi = {name:newTask.name.trim()}
const newTaskCopy = {...newTask,...senza_spazi} // {3,4,6,7}

// console.log(newTaskCopy);

// newTask.name = newTask.name.trim()