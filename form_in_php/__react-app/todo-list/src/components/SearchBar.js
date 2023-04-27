import { useState } from "react";

const SearchBar = (props) =>{
    
    // valore iniziale dello stato è una stringa vuota,use state rest due elementi di un aray 
    // l indice 0 dell'array è la variabile che rappresenta lo stato. la seconda gestisce il cambiamento di stato
    // x aprire il form con dei valori gia scritti bisogna giocare con lo stato iniziale quindi con  usestate('Mario')

    // hook useState 
    const[taskName,setTaskName] = useState('') 
    const[taskDueDate,setTaskDueDate] = useState('')
   
    function onAddTask() {
        const newTask ={
          name:taskName.trim(),
          due_date:taskDueDate,
          done:false
        }
        
        props.parentAddTask(newTask)
        //mettiamo una stringa vuota per ripulire il campo di testo dopo che aggiungo la task
        setTaskName('')
    }

    return (
        <section className="container">
         <div id="newtask" >
            <input type="text" 
                  value={taskName}
                //   si fa una funz anonima e si prende il value di evento associato a settaskname quindi il valore che è associato al cambiamento di stato
                  onChange={(evento)=>setTaskName(evento.target.value)}
                placeholder="Add Tasks"/>

            <button id="push" 
            onClick={onAddTask}
            disabled={!taskName.trim().length>0}
            >Add</button>
            <div>{!taskName.trim().length>0?'Devi inserire un titolo':' '}</div>
            <label htmlFor="date"></label>
            <input 
                    type="date"
                    value={taskDueDate}
                    // target è l'oggetto che ha scatenato l'evento in questo caso il form ma non tutti ce lhanno
                    onChange={(evento)=>setTaskDueDate(evento.target.value)} 
                    placeholder="inserisci data" 
                    id="date" 
                    name="date"/>    
        </div>
        </section>
    );  
}

export default SearchBar