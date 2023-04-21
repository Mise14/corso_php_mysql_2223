

const TaskItem = props => {
    return (
        <li className={props.done ? 'done':''}>
        <div id="tasks">
            <input checked={props.done} className="form-check-input" type="checkbox" defaultValue="" id="flexCheckDefault"></input>
            <label htmlFor="task">{props.nome_task}</label>
            <input type="text" id="text" name="task"></input>
            <button type="button" className="btn-close" aria-label="Close"></button>
        </div>
        </li>
    )
}

export default TaskItem;

