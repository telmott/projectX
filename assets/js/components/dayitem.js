import React from 'react';

import ActList from './actlist.js';
import DelDayButton from './deldaybutton.js';


class DayItem extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            id: this.props.id,
            title: this.props.title,
            content: this.props.content,
            availableActs: this.props.availableActs,
            selectedActs: this.props.selectedActs,
            notSaved: false
        }
        this.handleDaySubmit = this.handleDaySubmit.bind(this);
        this.handleInputChange = this.handleInputChange.bind(this);
        this.filterSelectedActs = this.filterSelectedActs.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
                availableActs: nextProps.availableActs,
                selectedActs: nextProps.selectedActs
        }); 
    }

    handleDaySubmit(e) {
        e.preventDefault();
        this.serverRequest = jQuery.ajax({
            url: projectxRest.url + 'wp/v2/days/' + this.state.id,
            method: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader( 'X-WP-Nonce', projectxRest.nonce );
            },
            data: {
                "title":this.state.title,
                "content":this.state.content,
                "status":"publish",
                "parent":this.props.parent
            }
        }).done( function(result) {
                this.setState({
                    id: result.id,
                    notSaved: false
                })
            }.bind(this)
        )
    }

    handleInputChange(e) {
        var target = e.target;
        var value = target.value;
        var name = target.name;

        this.setState({
            [name]: value,
            notSaved: true
        })
    }

    filterSelectedActs() {

        // TODO: add day value calculation here...
        return this.state.selectedActs.filter(act => {
            return act.dayID == this.state.id;
        });
    }

    getSaveButton() {
        if (this.state.notSaved) {
            return(<input key={'save' + this.state.id} type="submit" value="Save" className="button button-primary button-small" />);
        }
    }

    render() {
        return(
            <div key={this.state.id} className="tour-day-item">
                <form key={"form" + this.state.id} onSubmit={this.handleDaySubmit}>
                <div key="title-input-wrapper">
                        <label key={"label-title" + this.state.id} htmlFor="title">Title:</label>
                        <input key={"input-title" + this.state.id} name="title" onChange={this.handleInputChange} value={this.state.title} className="input-tour-day-item"/>
                    </div>
                    <div key="text-input-wrapper">
                        <label key={"label-text" + this.state.id} htmlFor="content">Text:</label>
                        <textarea key={"input-text" + this.state.id} name="content" onChange={this.handleInputChange} value={unescape(this.state.content.replace(/<\/?[^>]+(>|$)/g, ""))} className="input-tour-day-item" />
                    </div>
                    <ActList 
                        key={'activities-wrapper' + this.state.id}
                        availableActs={this.state.availableActs}
                        selectedActs={this.filterSelectedActs()}
                        dayId={this.state.id}
                        handleSelectActivity={this.props.handleSelectActivity}
                    />
                    <div key={'buttons-wrapper' + this.state.id} className="form-day-buttons-wrapper">
                        {this.getSaveButton()}
                        <DelDayButton key={'del' + this.state.id} itemId={this.state.id} del={this.props.handleDayDelete} />
                    </div>
                </form>
            </div>
        );
    }
}

export default DayItem;