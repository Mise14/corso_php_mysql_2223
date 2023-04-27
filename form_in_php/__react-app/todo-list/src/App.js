
import { useState } from 'react';
import './App.css';

import TaskItem from "./components/TaskItem/TaskItem";
import TaskList from './components/TaskList/TaskList';
import SearchBar from './components/SearchBar';
import { addTask, removeTask , updateTask} from './service/TodoService';

function App() {

  const [taskListData, setTaskListData] = useState([]);
  //const taskListData = []
  // const taskListData = [
  //   {
  //     task_id: 10,
  //     user_id: 12,
  //     name: "comprare il latte",
  //     due_date:"2023-04-04",
  //     done: true
  //   },
  //   {
  //     task_id: 12,
  //     user_id: 12,
  //     name: "leggere un mauale a caso",
  //     due_date:"2023-04-21",
  //     done: false
  //   }
    
  //   ]
function parentAddTask(newTask){
  const newTaskListData = addTask(newTask,taskListData)
  setTaskListData(newTaskListData)
}

function parentRemoveTask(taskId){
  const res= removeTask(taskId,taskListData)
    setTaskListData(res);
}

function onUpdateStatus(taskId){
  const res= updateTask(taskId,taskListData)
  console.log("parent"+taskId)
    setTaskListData(res);
}
  
    
return (
  <main>

    {/* <button onClick={aggiungiTask}>Add Task</button> */}
    <TaskList header={'Paolo'} tasks={taskListData}>
      {taskListData.map( task => <TaskItem key={task.task_id} onUpdateStatus={onUpdateStatus} parentRemoveTask={parentRemoveTask} id={task.id} done={task.done} nome_task={task.name} /> )}
    </TaskList>

    <SearchBar parentAddTask={parentAddTask}> </SearchBar>
    {/* <TaskList header={'Giovanni'} tasks={taskListData}>
      { taskListData.map( task => <TaskItem key={task.task_id} done={task.done} nome_task={task.name} /> )}
    </TaskList> */}
  </main>
)
}

export default App;