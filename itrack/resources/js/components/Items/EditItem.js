import React, { Component } from "react";

class EditItem extends Component {
    constructor(props) {
        super(props);
        this.state = {
            item_name: "",
            errors: [],
        };

        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleEditSubmit = this.handleEditSubmit.bind(this);
    }

    componentDidMount() {
        const itemId = this.props.match.params.id;
        fetch(`/api/items/${itemId}/edit`)
            .then((response) => response.json())
            .then((data) => this.setState({ item_name: data.item.item_name }));
    }

    handleFieldChange(event) {
        //const [name, value] = event.target;
        this.setState({ [event.target.name]: event.target.value });
    }

    fieldHasError(field) {
        return !!this.state.errors[field];
    }

    handleErrors(field) {
        if (this.fieldHasError(field)) {
            return (
                <span className="invalid-feedback text-danger">
                    <strong>{this.state.errors[field][0]}</strong>
                </span>
            );
        }
    }

    handleEditSubmit(event) {
        event.preventDefault();
        axios
            .patch(`/api/items/${this.props.match.params.id}`, {
                item_name: this.state.item_name,
            })
            .then((response) => {
                if (response.data.success) {
                    alert("Item edited successfully!");
                }
            })
            .catch((error) =>
                this.setState({ errors: error.response.data.errors })
            );
    }

    render() {
        return (
            <div className="bg-white p-3">
                <form onSubmit={this.handleEditSubmit}>
                    <div className="form-group">
                        <label className="label form-label font-weight-bold">
                            WHAT WOULD YOU LIKE TO CALL THE NEW ITEM?
                        </label>
                        <input
                            type="text"
                            name="item_name"
                            className={`form-control ${
                                this.fieldHasError("item_name")
                                    ? "is-invalid"
                                    : ""
                            }`}
                            onChange={this.handleFieldChange}
                            value={this.state.item_name}
                        />
                        {this.handleErrors("item_name")}
                    </div>

                    <div className="form-group">
                        <button
                            type="submit"
                            className="btn btn-sm btn-primary"
                        >
                            SUBMIT
                        </button>
                    </div>
                </form>
            </div>
        );
    }
}

export default EditItem;
