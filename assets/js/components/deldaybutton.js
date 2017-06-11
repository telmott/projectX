var element = React.createElement;

class DelDayButton extends React.Component {
    constructor(props) {
        super(props)
    }

    render() {
        if (this.props.itemId != '') {
            return(
                element('a', {key: "del-day-button", onClick: this.props.del, className: "button button-secondary button-small", href: "#", id: this.props.itemId}, 'Delete')
            )
        }
        return null;
    }
}

export default DelDayButton;