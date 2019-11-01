import React from 'react';
import { useState } from 'react';

function Task({task, deleteTask, changeStatus, changeName}) {

    const [ taskname, setTaskName ] = useState('');

    return (
        <div>
            <form
                onSubmit={e => changeName(e, taskname, task.id)}
            >
                <input
                    type="text"
                    name="name"
                    defaultValue={task.name}
                    // className="not-editable"
                    onChange={e => setTaskName(e.target.value)}
                />
                <input
                    type="checkbox"
                    name="is_completed"
                    defaultChecked={task.is_completed}
                    onClick={e => changeStatus(e, task.id)}
                />
                <input
                    type="submit"
                    value="Update"
                />
            </form>

            <a href="" onClick={e => deleteTask(e, task.id)} >Delete</a>
        </div>
    );
}

export default Task;
