import React from 'react';

import Alert from '../layouts/Alert';
import axios from 'axios';
import { useState } from 'react';

function TaskForm({addTask}) {

    const [ taskname, setTaskName] = useState('');
    const [ error, setError ] = useState(false);
    const [ errorMessage, setErrorMessage ] = useState('');

    // funcion que se ejecuta al hacer submit
    const handleTaskFormSubmit = e => {
        e.preventDefault();

        //validate data
        const task = validateTask(taskname);

        if (task) {
            makeRequest(task)
            .then(res => {
                switch(res.data.status) {
                    case 'error':
                        setErrorMessage(res.data.message);
                        setError(true);
                        break;
                    case 'success':
                        addTask(res.data.data);
                        setTaskName('');
                        break;
                }
            });
        }
    }

    // toma el valor del campo taskname y lo valida
    const validateTask = taskname => {

        if (taskname === '' || !taskname.trim()) {
            setErrorMessage('El nombre no puede estar vacio');
            setError(true);
            return false;
        }

        // if not empty create the task object
        const task = {
            'name' : taskname.trim()
        }

        return task;
    }

    // hacer peticion con axios
    const makeRequest = async task => {
        // Get the url
        const url = window.location.origin;

        // Get the project
        const routeProject = window.location.pathname.split('/').pop();

        return axios.post(`${url}/${routeProject}/tasks`, task);

    }

    return (
        <div>
          <h2>Tareas de Wallapp</h2>

            <form
                onSubmit={handleTaskFormSubmit}
            >
                <input
                    type="text"
                    name="taskname"
                    value={taskname}
                    onChange={e => setTaskName(e.target.value)}
                />

                <input
                    type="submit"
                    value="Add"
                />
            </form>

            { error ? <Alert message={errorMessage} type="error" /> : null }
        </div>
    );
}

export default TaskForm;
