import React from "react";
import { BrowserRouter, Route, Switch } from "react-router-dom";
import ReactDOM from "react-dom";
import AllItemsComponent from "./components/Items/AllItemsComponent";
import EditItem from "./components/Items/EditItem";
import CreateItem from "./components/Items/CreateItem";
import AllStockingsComponent from "./components/stockings/AllStockingsComponent";
import CreateStock from "./components/stockings/CreateStock";

function Index() {
    return (
        <BrowserRouter>
            <Switch>
                <Route path="/items" component={AllItemsComponent} />
                <Route path="/items/:id/edit" component={EditItem} />
                <Route path="/items/create" component={CreateItem} />
                <Route path="/stockings" component={AllStockingsComponent} />
                <Route path="/stockings/create" component={CreateStock} />
            </Switch>
        </BrowserRouter>
    );
}

ReactDOM.render(<Index />, document.getElementById("app"));
