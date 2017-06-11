'use strict';

var element = React.createElement;

import AddDayButton from './components/addday.js';
import DayList from './components/daylist.js';

class TourMetaBoxWrapper extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            tourId: lptlusTourId.TourId,
            activities: [],
            selectedAct: [],
            dayList: []
        }
        this.addDay = this.addDay.bind(this);
        this.handleSelectActivity = this.handleSelectActivity.bind(this);
        this.handleDayDelete = this.handleDayDelete.bind(this);
        this.nextId = this.nextId.bind(this);
    }
    
    addDay(e) {
        e.preventDefault();
        let nextIdValue = this.nextId();
        this.setState({
            total: this.state.dayList.push(
                {
                    id: '',
                    title: {
                        rendered: 'Day' + nextIdValue
                    },
                    content: {
                        rendered: 'teste'
                    }
                }
            )
        });
    }

    handleSelectActivity(e) {
        var dayID = e.target.name;
        var actID = e.target.id;
        var checked = e.target.checked;
        if (checked) {
            this.setState(function(prevState, nextProps) {
                var selected = prevState.activities.find(function(act) {
                    return act.id == actID;
                });
                prevState.selectedAct.push({dayID: dayID, act: selected});
                
                return {
                    activities: prevState.activities.filter(function(act) {
                        return act.id != actID;
                    }),
                    selectedAct: prevState.selectedAct
                };
            });
        }
    }

    handleDayDelete(e) {
        e.preventDefault();
        
        var dayID = e.target.id

        this.serverRequest = jQuery.ajax({
            url: lptlusWpApiSettings.root + 'wp/v2/days/' + dayID,
            method: 'DELETE',
            beforeSend: function (xhr) {
                xhr.setRequestHeader( 'X-WP-Nonce', lptlusWpApiSettings.nonce );
            }
        }).done( function(result) {
                
            }
        )
    }

    nextId() {
        return (this.state.dayList.length + 1);
    }

    componentDidMount() {
        this.serverRequest = jQuery.get('http://localhost/wp-loveptlikeus.com/wp-json/wp/v2/resources?res_type=5&region=9', function (result) {
            const acts = [...result];
            // const handleSelectActivity = this.handleSelectActivity;
            this.setState({
                // activities: acts.map(function(act) {
                //     return (element('input', {key: act.id, id: act.id, title: act.title.rendered, type: "checkbox", util: handleSelectActivity}, null))
                // })
                activities: acts
            })
        }.bind(this));

        this.serverRequest = jQuery.get('http://localhost/wp-loveptlikeus.com/wp-json/wp/v2/days?parent=' + this.state.tourId, function (result) {
            const days = [...result];
            // const handleDayDelete = this.handleDayDelete;
            // var activities = this.state.activities;
            // var selectedAct = this.state.selectedAct;
            this.setState({
                // dayList: posts.map(function(post) {
                //     return (element(DayItem, {
                //         key: post.id, 
                //         id: post.id, 
                //         title: post.title.rendered, 
                //         text: post.content.rendered, 
                //         del: handleDayDelete, 
                //         activities: activities,
                //         selectedAct: selectedAct
                //     }, null))
                // })
                dayList: days
            })
        }.bind(this)); 
    }

    render() {
        return(
            element('div', {className: "tourmetabox-inner"}, [
                element(DayList, {
                    key: "day-list",
                    activities: this.state.activities, 
                    selectedAct: this.state.selectedAct,
                    dayList: this.state.dayList,
                    handleDayDelete: this.handleDayDelete,
                    handleSelectActivity: this.handleSelectActivity
                }, null),
                <AddDayButton key="add-day-button" onclick={this.addDay} />
            ])
        );
    }
}

ReactDOM.render(
  element(TourMetaBoxWrapper, null, null),
  document.getElementById('tourMetaBox')
);