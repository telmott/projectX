import React from 'react';

import ActListItem from './actlistitem.js';

class ActList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            availableActs: this.props.availableActs,
            selectedActs: this.props.selectedActs
        };
        this.getActivitiesItemList = this.getActivitiesItemList.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            availableActs: nextProps.availableActs,
            selectedActs: nextProps.selectedActs
        });
    }

    getActivitiesItemList() {
        let activitiesItemList = this.state.selectedActs.map(act => {
            return <ActListItem 
                key={'act-item' + act.act.id}
                id={act.act.id}
                day={act.dayID}
                checked={true}
                util={this.props.handleSelectActivity}
                title={act.act.title.rendered}
            />
        });

        activitiesItemList.push(this.state.availableActs.map(act => {
            return <ActListItem 
                id={act.id}
                day={this.props.dayId}
                checked={false}
                util={this.props.handleSelectActivity}
                title={act.title.rendered}
            />
        }));

        return activitiesItemList;
    }

    render() {
        if (this.props.dayId != '') {
            return(
                <ul className="act-list-wrapper">{this.getActivitiesItemList()}</ul>   
            );
        }
        return null;
    }
}

export default ActList;