import React from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';
import { useState, useEffect } from 'react';

// Components
import TaskForm from './TaskForm';
import TasksList from './TasksList';

function Tasks() {

    const [ tasks, setTasks ] = useState([]);
    const [ refresh, setRefresh ] = useState(false);

    useEffect(() => {
        const getTasks = async () => {
            // Get the url
            const url = window.location.origin;

            // Get the project
            const routeProject = window.location.pathname.split('/').pop();

            // make request with axios
            const res = await axios.get(`${url}/${routeProject}/tasks`);
            setTasks(res.data);

        }

        getTasks();
    }, [refresh]);

    const addTask = newTask => {
        setTasks([...tasks, newTask]);
    }

    const updateTask = editTask => {
        const stateTasks = [...tasks];

        const newTasks = stateTasks.map(task => {
            if (task.id === editTask.id) {
                task = editTask
            }
            return task;
        });

        setTasks(newTasks);
    }

    const removeTask = (taskId) => {

        // crear una copia del state
        const stateTasks = [...tasks];

        // crear nuevo objeto sin la tarea a eliminar
        const newTasks = stateTasks.filter(task => task.id !== taskId);

        // actualizar el state
        setTasks(newTasks);

    }

    return (
        <div>
            <TaskForm
                addTask={addTask}
            />
            <TasksList
                tasks={tasks}
                updateTask={updateTask}
                removeTask={removeTask}
            />
        </div>
    );
}

if (document.getElementById('tasks')) {
    ReactDOM.render(<Tasks />, document.getElementById('tasks'));
}
