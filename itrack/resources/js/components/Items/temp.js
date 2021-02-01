import React, { Component } from "react";
import ReactDOM from "react-dom";
import Item from "./Item";

//import bootstrap and jquery
import "bootstrap/dist/css/bootstrap.css";
import "jquery/dist/jquery.min.js";

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import axios from "axios";
import { indexOf } from "lodash";

class Items extends Component {
    constructor() {
        super();
        this.state = {
            items: [],
        };

        this.handleToggleStatus = this.handleToggleStatus.bind(this);
        this.handleDeleteItem = this.handleDeleteItem.bind(this);
    }

    componentDidMount() {
        fetch("/get_items")
            .then((response) => response.json())
            .then((data) => this.setState({ items: data.items }))
            .catch((err) => console.log("Error:", err));
    }

    handleToggleStatus(item) {
        axios.patch(`/items/${item.id}/toggle_status`).then((response) => {
            if (response.data.success) {
                const items = [...this.state.items];
                const indexOfItem = items.indexOf(item);
                items[indexOfItem] = { ...item };
                items[indexOfItem].status = !items[indexOfItem].status;
                this.setState({ items });
            } else {
                console.log("An error occured!");
            }
        });
    }

    handleDeleteItem(item) {
        axios.delete(`/items/${item.id}`).then((response) => {
            if (response.data.success) {
                let items = this.state.items.filter(
                    (item_) => item_.id !== item.id
                );
                this.setState({ items });
            }
        });
    }

    render() {
        //const { items } = this.state.items;
        return (
            <table className="table bg-white" id="items_table">
                <thead>
                    <tr className="text-center">
                        <th>#</th>
                        <th>ITEM NAME</th>
                        <th>QUANTITY</th>
                        <th>STATUS</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    {this.state.items.map((item) => (
                        <Item
                            key={item.id}
                            item={item}
                            onToggleStatus={this.handleToggleStatus}
                            onDeleteItem={this.handleDeleteItem}
                        />
                    ))}
                </tbody>
            </table>
        );
    }
}

if (document.getElementById("items")) {
    ReactDOM.render(<Items />, document.getElementById("items"));
}

////////////////////////////////////////////////////////////////////////
import React from "react";

export default class Item extends React.Component {
    constructor(props) {
        super(props);
    }

    presentQuantityBadge() {
        let badgeClasses = "badge badge-pill badge-";
        if (this.props.item.quantity <= 10) {
            badgeClasses += "warning";
        } else if (
            this.props.item.quantity > 10 &&
            this.props.item.quantity < 50
        ) {
            badgeClasses += "primary";
        } else {
            badgeClasses += "success";
        }

        return badgeClasses;
    }

    presentStatusBadges() {
        let statusClasses = "btn btn-sm btn-";
        statusClasses += this.props.item.status ? "success" : "warning";
        return statusClasses;
    }

    render() {
        return (
            <tr className="text-center">
                <td className="text-center">{this.props.item.id}</td>
                <td>{this.props.item.item_name}</td>
                <td>
                    <small className={this.presentQuantityBadge()}>
                        {" "}
                        {this.props.item.quantity}
                    </small>
                </td>
                <td>
                    <button
                        className={this.presentStatusBadges()}
                        onClick={() =>
                            this.props.onToggleStatus(this.props.item)
                        }
                    >
                        {this.props.item.status ? "Active" : "Inactive"}
                    </button>
                </td>
                <td>
                    <a href="" className="btn btn-sm btn-primary">
                        Edit
                    </a>
                    &nbsp;
                    <button
                        className="btn btn-sm btn-danger"
                        onClick={() => this.props.onDeleteItem(this.props.item)}
                    >
                        Delete
                    </button>
                </td>
            </tr>
        );
    }
}
///////////////////////////////////////////////////////////////
handleToggleStatus(item) {
    axios.patch(`/items/${item.id}/toggle_status`).then((response) => {
        if (response.data.success) {
            const items = [...this.state.items];
            const indexOfItem = items.indexOf(item);
            items[indexOfItem] = { ...item };
            items[indexOfItem].status = !items[indexOfItem].status;
            this.setState({ items });
        } else {
            console.log("An error occured!");
        }
    });
}

handleDeleteItem(item) {
    axios.delete(`/items/${item.id}`).then((response) => {
        if (response.data.success) {
            let items = this.state.items.filter(
                (item_) => item_.id !== item.id
            );
            this.setState({ items });
        }
    });
}