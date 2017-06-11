class AddDayButton extends React.Component {
    constructor(props) {
        super(props)
    }

    render() {
        return(
            <div className="add-day-button-wrapper">
                <a key="add-day-button" onClick={this.props.onclick} className="button button-primary button-large" href="#">Add Day</a>
            </div>
        )
    }
}

export default AddDayButton;