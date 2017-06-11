import DayItem from './dayitem.js';

var element = React.createElement;

class DayList extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            dayList: this.props.dayList,
            activities: this.props.activities,
            selectedAct: this.props.selectedAct
        }
        this.getDayItemList = this.getDayItemList.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            activities: nextProps.activities,
            selectedAct: nextProps.selectedAct,
            dayList: nextProps.dayList
        });
    }

    getDayItemList() {
        let dayItemList = this.state.dayList.map(function(day) {
            return <DayItem 
                key={day.id}
                id={day.id}
                title={day.title.rendered}
                content={day.content.rendered}
                handleDayDelete={this.props.handleDayDelete}
                handleSelectActivity={this.props.handleSelectActivity}
                activities={this.state.activities}
                selectedAct={this.state.selectedAct}
            />
        }.bind(this));

        return dayItemList;
    }

    render() {
        return(
            element('div', {className: "tour-day-item-wrapper"}, this.getDayItemList())
        )
    }
}

export default DayList;