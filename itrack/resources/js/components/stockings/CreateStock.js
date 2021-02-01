import React, { Component } from "react";
import { Link } from "react-router-dom";

class CreateStock extends Component {
    constructor() {
        super();
        this.state = {
            items: [],
            users: [],
            from: "Stores",
            item_id: "",
            user_id: "",
            quantity: "",
        };
    }
}
