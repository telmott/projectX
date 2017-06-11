var element = React.createElement;

import ActListItem from './actlistitem.js';

class ActList extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            activities: this.props.activities,
            selectedAct: this.props.selectedAct
        };
        this.getActivitiesItemList = this.getActivitiesItemList.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            activities: nextProps.activities,
            selectedAct: nextProps.selectedAct
        });
    }

    getActivitiesItemList() {
        let daySelectedAct = this.state.selectedAct.filter(act => {
            return act.dayID == this.props.dayId;
        });

        let activitiesItemList = daySelectedAct.map(act => {
            return <ActListItem 
                key={'act-item' + act.act.id}
                id={act.act.id}
                day={act.dayID}
                checked={true}
                util={this.props.handleSelectActivity}
                title={act.act.title.rendered}
            />
        });

        activitiesItemList.push(this.state.activities.map(act => {
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
        return(
            element('ul', {className: "act-list-wrapper"}, this.getActivitiesItemList())
        );
    }
}

export default ActList;