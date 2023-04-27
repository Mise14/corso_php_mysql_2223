import { activeFilter,addTask,completedFilter ,removeTask,updateTask} from "./TodoService.js";



const tasklist = [
    
        { 
        name:"comprare il latte",
        user_id:12,
        id:11,
        due_date:"2023-04-25",
        done:true
        },
        {
        name:"comprare il dentifricio",
        user_id:12,
        id:12,
        due_date:"2023-04-25",
        done:false
        }, 
        {
        name:"comprare il la farina",
        user_id:10,
        id:13,
        due_date:"2023-04-22",
        done:true
        },
    ]


    const activeTaskList = activeFilter(tasklist)

    // console.log(activeTaskList);

    if(!(activeTaskList.length == 1)){ 
        console.log("test fallito me ne aspettavo uno solo");
    }


    const complitedTask = completedFilter(tasklist)

    // console.log(complitedTask)
    if(!(complitedTask.length == 2)){
        console.log("test fallito"); 
    }


    const newTask = {
        name:"fare i compiti",
        user_id :12,
        due_date : "2000-03-01"
    }

    //copia = {name:"fare i compiti", user_id :12,due_date : "2000-03-01"}
    
    const newTasklist = addTask(newTask,tasklist)

    //console.log(newTasklist);

    if( !(newTasklist.length == 4) ) {
        console.log("test addTask Fallito")
    }

    const newTaskNoName = {    
        user_id :12,
        due_date : "2000-03-01"
    }
    
    try {
        const addTaskNoName = addTask(newTaskNoName,tasklist)
        console.log("il test è nome vuoto fallito");
    } catch (error) {
       
        if(!(error.message === 'manca il nome alla task')){
            console.log("tes fallito, non ho trovato vl'errore che mi aspettavo")
        }
       // console.log(error.message)
    }



    const emptyStringName = { 
        name:"",   
        user_id :12,
        due_date : "2000-03-01"
    }
    
    try {
        const addTaskNoName = addTask(emptyStringName,tasklist)
        console.log("il test è stringa vuota è fallito");
    } catch (error) {
        if(!(error.message === 'manca il nome alla task')){
            console.log("tes fallito, non ho trovato vl'errore che mi aspettavo")
        }
    }


    const spaceStringName = { 
        name:"          ",   
        user_id :12,
        due_date : "2000-03-01"
    }
    
    try {
        const addTaskNoName = addTask(spaceStringName,tasklist)
        console.log("il test è spazi vuoti  è fallito");
    } catch (error) {
        if(!(error.message === 'manca il nome alla task')){
            console.log("tes fallito, non ho trovato vl'errore che mi aspettavo")
        }
    }



    const toTrimTask = { 
        name:"   Rinnovare patente       ",   
        user_id :12,
        due_date : "2000-03-01"
    }

    
     const addToTrimTask = addTask(toTrimTask,tasklist)
    //console.log("addTaskNoName il test è spazi vuoti  è fallito");
    
    const res = addToTrimTask.find(function(task,index){
        return task.name == toTrimTask.name.trim()
    })

    if(res == undefined){
        console.log("test fallito per addToTrimTask")
    }
    
        

    //console.log(addTaskNoName);


    // const task_id = 12;

    // const removedTasklist =  removeTask(task_id,tasklist)
    // console.log("----------")
    // console.log(removedTasklist)


    const updatedTaskItem = {
        "name" : "Nuovo Nome Task",
        "id" : 12
    } 

    const updatetedTaskslist = updateTask(updatedTaskItem,tasklist)

    console.log(updatetedTaskslist)