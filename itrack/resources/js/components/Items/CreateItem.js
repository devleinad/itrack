import React, { Component } from "react";
import ReactDOM from "react-dom";
import axios from "axios";

export default class CreateItem extends Component {
    constructor() {
        super();
        this.state = {
            item_name: "",
            errors: [],
        };

        this.handleFieldChange = this.handleFieldChange.bind(this);
        this.handleSubmit = this.handleSubmit.bind(this);
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

    handleSubmit(event) {
        event.preventDefault();
        axios
            .post("/api/items", {
                item_name: this.state.item_name,
            })
            .then((response) => {
                if (response.data.success) {
                    alert("Item created successfully!");
                }
            })
            .catch((error) =>
                this.setState({ errors: error.response.data.errors })
            );
    }

    render() {
        return (
            <div className="bg-white p-3">
                <form method="POST" onSubmit={this.handleSubmit}>
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
