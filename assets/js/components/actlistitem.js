import React from 'react';
import {decode} from 'he';

class ActListItem extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return(
            <li key={'li-' + this.props.id}>
                <input key={'checkbox-' + this.props.id}
                    type="checkbox" 
                    onChange={this.props.util} 
                    id={this.props.id}
                    name={this.props.day}
                    checked={this.props.checked} />
                <span key={'legend' + this.props.id}>{decode(this.props.title)}</span>
            </li>
        )
    }
}

export default ActListItem