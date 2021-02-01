import React, { Component } from "react";
import Item from "./Item";
import { Link } from "react-router-dom";

//import bootstrap and jquery
import "bootstrap/dist/css/bootstrap.css";
import "jquery/dist/jquery.min.js";

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import axios from "axios";

export default class AllItemsComponent extends Component {
    constructor() {
        super();
        this.state = {
            items: [],
        };

        this.handleToggleStatus = this.handleToggleStatus.bind(this);
        this.handleDeleteItem = this.handleDeleteItem.bind(this);
    }

    handleToggleStatus(item) {
        axios.patch(`/api/items/${item.id}/toggle_status`).then((response) => {
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
        axios.delete(`/api/items/${item.id}`).then((response) => {
            if (response.data.success) {
                let items = this.state.items.filter(
                    (item_) => item_.id !== item.id
                );
                this.setState({ items });
            }
        });
    }

    componentDidMount() {
        fetch("/api/items")
            .then((response) => response.json())
            .then((data) => this.setState({ items: data.items }))
            .catch((err) => console.log("Error:", err));
    }

    render() {
        //const { items } = this.state.items;
        return (
            <>
                <Link
                    to="/items/create"
                    className="btn btn-secondary btn-md mb-3"
                >
                    Add Item
                </Link>
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
            </>
        );
    }
}
