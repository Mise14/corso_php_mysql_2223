

const TaskItem = props => {
    return (
        <div id="tasks">
            <input className="form-check-input" type="checkbox" value="" id="flexCheckDefault"> </input>
            <input type="text" id="text"> </input>
            <button type="button" className="btn-close" aria-label="Close"></button>
        </div>
    )
}

export default TaskItem;