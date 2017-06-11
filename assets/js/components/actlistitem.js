var element = React.createElement;

class ActListItem extends React.Component {
    constructor(props) {
        super(props);
    }

    render() {
        return(
            element('li', {key: 'li-' + this.props.id}, [
                element('input', {
                    key: 'checkbox-' + this.props.id, 
                    type: "checkbox", 
                    onChange: this.props.util, 
                    id: this.props.id,
                    name: this.props.day,
                    checked: this.props.checked
                }, null),
                element('span', {key: 'legend' + this.props.id}, this.props.title)
            ])
        )
    }
}

export default ActListItem;