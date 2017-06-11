var element = React.createElement;

import ActList from './actlist.js';
import DelDayButton from './deldaybutton.js';


class DayItem extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            id: this.props.id,
            title: this.props.title,
            content: this.props.content,
            activities: this.props.activities,
            selectedAct: this.props.selectedAct
        }
        this.handleInputChange = this.handleInputChange.bind(this);
        this.handleDaySubmit = this.handleDaySubmit.bind(this);
    }

    componentWillReceiveProps(nextProps) {
        this.setState({
            id: nextProps.id,
            title: nextProps.title,
            content: nextProps.content,
            activities: nextProps.activities,
            selectedAct: nextProps.selectedAct
        });
    }

    handleInputChange(e) {
        var target = e.target;
        var value = target.value;
        var name = target.name;

        this.setState({
            [name]: value
        })
    }

    handleDaySubmit(e) {
        e.preventDefault();
        this.serverRequest = jQuery.ajax({
            url: lptlusWpApiSettings.root + 'wp/v2/days/' + this.state.id,
            method: 'POST',
            beforeSend: function (xhr) {
                xhr.setRequestHeader( 'X-WP-Nonce', lptlusWpApiSettings.nonce );
            },
            data: {
                "title":this.state.title,
                "content":this.state.text,
                "status":"publish",
                "parent":this.state.parent
            }
        }).done( function(result) {
                this.setState({
                    id: result.id
                })
            }.bind(this)
        )
    }

    render() {
        return(
            element('div', {key: this.state.id, className: "tour-day-item"}, [
                element('form', {key: "form" + this.state.id, onSubmit: this.handleDaySubmit}, [
                    element('label', {key: "label-title" + this.state.id, name: "title"}, [
                        element('input', {
                            key: "input-title" + this.state.id,
                            name: "title",
                            onChange: this.handleInputChange,
                            value: this.state.title
                        }, null)
                    ], 'Title:'),
                    element('label', {key: "label-text" + this.state.id}, [
                        element('textarea', {
                            key: "input-text" + this.state.id,
                            name: "text",
                            onChange: this.handleInputChange,
                            value: this.state.content
                        }, null)
                    ], 'Text:'),
                    // element(ActList, {key: 'activities-wrapper' + this.state.id, activities: this.state.activities, dayID: this.state.id, selectedAct: this.state.selectedAct}, null),
                    <ActList 
                        key={'activities-wrapper' + this.state.id}
                        activities={this.state.activities}
                        selectedAct={this.state.selectedAct}
                        dayId={this.state.id}
                        handleSelectActivity={this.props.handleSelectActivity}
                    />,
                    element('div', {key: 'buttons-wrapper' + this.state.id, className: "form-day-buttons-wrapper"}, [
                        element('input', {key: 'save' + this.state.id, type: "submit", value: "Save", className: "button button-primary button-small"}, null),
                        element(DelDayButton, {key: 'del' + this.state.id, itemId: this.state.id, del: this.props.handleDayDelete}, null)
                    ]),
                    ,
                ]),
                
                
            ])
        );
    }
}

export default DayItem;