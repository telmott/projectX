'use strict';

import React from 'react';
import ReactDOM from 'react-dom';
import DayList from './components/daylist.js';
import AddDayButton from './components/addday.js';

class GuideMetaBoxWrapper extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            guideId: guide.Id,
            dayList: [],
            regionActs: []
        }
        this.addDay = this.addDay.bind(this);
        this.handleDayDelete = this.handleDayDelete.bind(this);
        this.getTotal = this.getTotal.bind(this);
    }

    componentDidMount() {
        this.serverRequest = jQuery.get(projectxRest.url + 'wp/v2/resources?res_type=5&regions=' + guide.Region, function (result) {
            const acts = [...result];
            this.setState({
                regionActs: acts
            })
        }.bind(this));

        this.serverRequest = jQuery.get(projectxRest.url + 'wp/v2/days?parent=' + this.state.guideId, function (result) {
            const days = [...result];
            const sortDays = days.sort((a, b) => (a.title.rendered.toUpperCase() > b.title.rendered.toUpperCase()) ? 1 : -1);
            this.setState({
                dayList: sortDays.map(day => {
                    day.keyId = this.randomKeyId();
                    return day;
                })
            })
        }.bind(this));
    }

    addDay(e) {
        e.preventDefault();
        let nextIdValue = this.nextId();
        this.setState({
            total: this.state.dayList.push(
                {
                    keyId: this.randomKeyId(),
                    id: '',
                    title: {
                        rendered: 'Day ' + nextIdValue
                    },
                    content: {
                        rendered: ''
                    }
                }
            )
        });
    }

    nextId() {
        return (this.state.dayList.length + 1);
    }

    randomKeyId() {
        return Math.random();
    }

    handleDayDelete(e) {
        e.preventDefault();
        
        var dayID = e.target.id

        // TODO: delete all meta for this day

        this.serverRequest = jQuery.ajax({
            url: projectxRest.url + 'wp/v2/days/' + dayID,
            method: 'DELETE',
            beforeSend: function (xhr) {
                xhr.setRequestHeader( 'X-WP-Nonce', lptlusWpApiSettings.nonce );
            }
        }).done( function(result) {
                this.setState({
                    dayList: this.state.dayList.filter(day => {
                        return day.id != dayID;
                    })
                });
            }.bind(this)
        )
    }

    getTotal() {
        return this.state.total ? true : false;
    }

    render() {
        return(
            <div>
                <DayList key="day-list" guideId={this.state.guideId} dayList={this.state.dayList} handleDayDelete={this.handleDayDelete} handleInputChange={this.handleInputChange} regionActs={this.state.regionActs} total={this.getTotal()} />
                <AddDayButton key="add-day-button" onclick={this.addDay} />
            </div>
        );
    }
}

ReactDOM.render(
    <GuideMetaBoxWrapper />,
    document.getElementById('tourMetaBox')
);