import React, { LabelHTMLAttributes } from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';

interface LabelProps extends LabelHTMLAttributes<HTMLLabelElement> {
    className?: string;
}

const Label: React.FC<LabelProps> = (props) => {
    const {
        className,
        children,
        ...rest
    } = props;

    return (
        <label className={classNames('label', className)} {...rest}>
            {children}
        </label>
    );
};

Label.propTypes = {
    className: PropTypes.string
};

export default Label;
