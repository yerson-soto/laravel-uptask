import React, { Fragment } from 'react';

import Task from './Task';
import Alert from '../layouts/Alert';

import axios from 'axios';
import { useState } from 'react';

function TasksList({tasks, updateTask, removeTask}) {

    const [ error, setError ] = useState(false);
    const [ errorMessage, setErrorMessage ] = useState('');

    const toggleTaskStatus = (e, taskId) => {

        const data = {
            id: taskId,
            attribute: e.target.name,
            [e.target.name]: e.target.checked
        }

        handleRequest(data);

    }

    const handleChangeName = (e, taskname, taskId) => {
        e.preventDefault();

        if (taskname === '' || !taskname.trim()) {
            console.log('se quedo igual')
            return;
        }

        const data = {
            id: taskId,
            attribute: 'name',
            name: taskname
        }

        handleRequest(data);

    }

    const handleTaskDelete = (e, taskId) => {
        e.preventDefault();

        // hacer peticion con axios
        makeDeleteRequest(taskId)
            .then(res => {
                removeTask(res.data.id);
            });

    }

    const makeDeleteRequest = async taskId => {
        // Get the url
        const url = window.location.origin;

        return await axios.delete(`${url}/tasks/${taskId}`);
    }

    const makeUpdateRequest = async data => {
        const url = window.location.origin;
        return await axios.put(`${url}/tasks/${data.id}`, data);

    }

    const handleRequest = data => {
        makeUpdateRequest(data)
            .then(res => {
                switch(res.data.status) {
                    case 'error':
                        setError(true);
                        setErrorMessage(res.data.message);
                        break;
                    case 'success':
                        updateTask(res.data.data)
                        break;
                }
            })
    }

    return (
        <Fragment>
            {tasks.map(task => (
                <Task
                    key={task.id}
                    task={task}
                    deleteTask={handleTaskDelete}
                    changeStatus={toggleTaskStatus}
                    changeName={handleChangeName}
                />
            ))}
            {error ? <Alert message={errorMessage} type="error" /> : null}
        </Fragment>
    );
}

export default TasksList;
