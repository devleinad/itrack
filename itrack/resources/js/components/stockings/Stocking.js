import React from "react";
import { Link } from "react-router-dom";

export default function Stocking(props) {
    return (
        <tr className="text-center">
            <td>{props.stock.from}</td>
            <td>{props.stock.item.item_name}</td>
            <td>{props.stock.quantity}</td>
            <td>{props.stock.receiver}</td>
            <td>
                <Link
                    to={`/items/${props.stock.id}/edit`}
                    className="btn btn-sm btn-secondary"
                >
                    Edit
                </Link>
                &nbsp;
                <button
                    className="btn btn-sm btn-danger"
                    onClick={() => props.onDeleteStock(props.stock)}
                >
                    Delete
                </button>
            </td>
        </tr>
    );
}
