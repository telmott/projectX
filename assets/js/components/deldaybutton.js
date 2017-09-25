import React from 'react';

class DelDayButton extends React.Component {
    constructor(props) {
        super(props)
    }

    render() {
        if (this.props.itemId != '') {
            return(
                <a key="del-day-button" id={this.props.itemId} href="#" className="button button-secondary button-small" onClick={this.props.del}>Delete</a>
            )
        }
        return null;
    }
}

export default DelDayButton;