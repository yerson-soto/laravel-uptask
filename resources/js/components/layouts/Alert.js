import React from 'react';

const Alert = ({message, type}) => {
    let className = `alert alert-${type}`
    return (
        <div className={className}>
            { message}
        </div>
    );
}

export default Alert;
