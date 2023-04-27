

const TaskItem = props => {

    function onRemoveTask(){
        console.log("task"+ props.id)
        props.parentRemoveTask(props.id)
    }

    function onUpdateStatus(){
        console.log("update" + props.id)
        props.onUpdateStatus(props.id)
    }

    return (
        <li className={props.done ? 'done':''}>
        <div id="tasks">
            <input onChange={onUpdateStatus} checked={props.done} className="form-check-input" type="checkbox" defaultValue="" id="flexCheckDefault"></input>
            <label htmlFor="task">{props.nome_task}</label>
            <input type="text" id="text" name="task"></input>
            <button type="button" className="btn-close" aria-label="Close"></button>
            <button className="edit" onClick={onUpdateStatus}>Edit</button>
            <button className="delete" onClick={onRemoveTask}>Delete</button>
        </div>
        </li>
    )
}

export default TaskItem;

