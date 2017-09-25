import React from 'react';
import DayItem from './dayitem.js';
import {decode} from 'he';

class DayList extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            dayList: this.props.dayList,
            availableActs: [],
            selectedActs: []
        }
        this.getDayItemList = this.getDayItemList.bind(this);
        this.handleSelectActivity = this.handleSelectActivity.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        if (!nextProps.total) {
            let selActs = [];
            let avaActs = nextProps.regionActs;
                
            nextProps.dayList.forEach(day => {
                this.serverRequest = jQuery.ajax({
                    url: projectxRest.url + 'wp/v2/posts/' + day.id + '/meta',
                    method: 'GET',
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader( 'X-WP-Nonce', projectxRest.nonce );
                    }
                }).done(result => {
                    const filterAct = result.filter(meta => {
                        return meta.key == "activities";
                    });
                    
                    filterAct.map(act => {
                        let actValue = JSON.parse(act.value);
                        selActs.push({metaId: act.id, dayID: day.id.toString(), act: actValue});
                        avaActs = avaActs.filter(act => {
                            return act.id != actValue.id;
                        })
                    });

                    this.setState({
                        selectedActs: selActs,
                        availableActs: avaActs
                    });
                });
            });
        }
        
        this.setState({
            dayList: nextProps.dayList
        });
    }

    randomKeyId() {
        return Math.random();
    }

    getDayItemList() {
        let dayItemList = this.state.dayList.map(function(day) {
            return <DayItem 
                key={day.keyId}
                id={day.id}
                parent={this.props.guideId}
                title={day.title.rendered}
                content={decode(day.content.rendered)}
                handleDayDelete={this.props.handleDayDelete}
                handleInputChange={this.props.handleInputChange}
                handleSelectActivity={this.handleSelectActivity}
                availableActs={this.state.availableActs}
                selectedActs={this.state.selectedActs}
            />
        }.bind(this));

        return dayItemList;
    }

    handleSelectActivity(e) {
        var dayID = e.target.name;
        var actID = e.target.id;
        var checked = e.target.checked;

        if (checked) {
            var selected = this.state.availableActs.find(function(act) {
                return act.id == actID;
            });

            this.serverRequest = jQuery.ajax({
                url: projectxRest.url + 'wp/v2/posts/' + dayID + '/meta',
                method: 'POST',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', projectxRest.nonce );
                },
                data: {
                    "key": "activities",
                    "value": JSON.stringify(selected)
                }
            }).done(result => {
                this.setState(function(prevState, nextProps) {
                    
                    prevState.selectedActs.push({metaId: result.id, dayID: dayID, act: selected});
                    
                    return {
                        availableActs: prevState.availableActs.filter(function(act) {
                            return act.id != actID;
                        }),
                        selectedActs: prevState.selectedActs
                    };
                });
            });

            
        }

        if (!checked) {
            var selected = this.state.selectedActs.find(function(act) {
                return act.act.id == actID;
            });

            this.serverRequest = jQuery.ajax({
                url: projectxRest.url + 'wp/v2/posts/' + dayID + '/meta/' + selected.metaId,
                method: 'DELETE',
                beforeSend: function (xhr) {
                    xhr.setRequestHeader( 'X-WP-Nonce', projectxRest.nonce );
                },
                data: {
                    "force": true
                }
            }).done(result => {
                console.log(result);
            });

            this.setState(function(prevState, nextProps) {
                
                prevState.availableActs.push(selected.act);
                
                return {
                    selectedActs: prevState.selectedActs.filter(function(act) {
                        return act.act.id != actID;
                    }),
                    availableActs: prevState.availableActs
                };
            });
        }
    }

    render() {
        return(
            <div className="tour-day-item-wrapper">{this.getDayItemList()}</div>
        )
    }
}

export default DayList;