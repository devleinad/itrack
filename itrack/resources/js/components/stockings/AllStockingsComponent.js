import React, { Component } from "react";
import Stocking from "./Stocking";
import { Link } from "react-router-dom";

//import bootstrap and jquery
import "bootstrap/dist/css/bootstrap.css";
import "jquery/dist/jquery.min.js";

//Datatable Modules
import "datatables.net-dt/js/dataTables.dataTables";
import "datatables.net-dt/css/jquery.dataTables.min.css";
import $ from "jquery";
import axios from "axios";

export default class AllStockingsComponent extends Component {
    constructor() {
        super();
        this.state = {
            stocks: [],
        };

        this.handleDeleteStock = this.handleDeleteStock.bind(this);
    }

    handleDeleteStock(stock) {
        axios.delete(`/api/stockings/${stock.id}`).then((response) => {
            if (response.data.success) {
                let stocks = this.state.stocks.filter(
                    (stock_) => stock_.id !== stock.id
                );
                this.setState({ stocks });
            }
        });
    }

    componentDidMount() {
        fetch("/api/stockings")
            .then((response) => response.json())
            .then((data) => this.setState({ stocks: data.stocks }))
            .catch((err) => console.log("Error:", err));
    }

    render() {
        return (
            <div>
                <Link
                    to="/stockings/create"
                    className="btn btn-secondary btn-md mb-3"
                >
                    New Stockings
                </Link>
                <table className="table bg-white">
                    <thead>
                        <tr className="text-center">
                            <th>FROM</th>
                            <th>ITEM</th>
                            <th>QUANTITY</th>
                            <th>RECEIVER</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        {this.state.stocks.map((stock) => (
                            <Stocking
                                key={stock.id}
                                stock={stock}
                                onDeleteStock={this.handleDeleteStock}
                            />
                        ))}
                    </tbody>
                </table>
            </div>
        );
    }
}
