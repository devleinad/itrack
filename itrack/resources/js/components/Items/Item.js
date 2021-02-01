import React from "react";
import { Link } from "react-router-dom";

export default function Item(props) {
    let presentQuantityBadge = () => {
        let badgeClasses = "badge badge-pill badge-";
        if (props.item.quantity <= 10) {
            badgeClasses += "warning";
        } else if (props.item.quantity > 10 && props.item.quantity < 50) {
            badgeClasses += "primary";
        } else {
            badgeClasses += "success";
        }

        return badgeClasses;
    };

    let presentStatusBadges = () => {
        let statusClasses = "btn btn-sm btn-";
        statusClasses += props.item.status ? "success" : "warning";
        return statusClasses;
    };

    return (
        <tr className="text-center">
            <td>{props.item.id}</td>
            <td>{props.item.item_name}</td>
            <td>
                <small className={presentQuantityBadge()}>
                    {" "}
                    {props.item.quantity}
                </small>
            </td>
            <td>
                <button
                    className={presentStatusBadges()}
                    onClick={() => props.onToggleStatus(props.item)}
                >
                    {props.item.status ? "Active" : "Inactive"}
                </button>
            </td>
            <td>
                <Link
                    to={`/items/${props.item.id}/edit`}
                    className="btn btn-sm btn-secondary"
                >
                    Edit
                </Link>
                &nbsp;
                <button
                    className="btn btn-sm btn-danger"
                    onClick={() => props.onDeleteItem(props.item)}
                >
                    Delete
                </button>
            </td>
        </tr>
    );
}
