import React, { InputHTMLAttributes } from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';

interface InputProps extends InputHTMLAttributes<HTMLInputElement> {
    invalid?: boolean;
    className?: string;
}

const Input: React.FC<InputProps> = (props) => {
    const {
        invalid,
        className,
        children,
        ...rest
    } = props;

    return (
        <input
            className={classNames(
                'form-control',
                { "is-invalid": invalid },
                className
            )}
            {...rest}
        />
    );
};

Input.propTypes = {
    invalid: PropTypes.bool,
    className: PropTypes.string
};

export default Input;
