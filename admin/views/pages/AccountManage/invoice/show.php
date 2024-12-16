<?php
// echo Page::title(["title"=>"Show Invoice"]);
// echo Page::body_open();
// echo Html::link(["class"=>"btn btn-success", "route"=>"invoice", "text"=>"Manage Invoice"]);
// echo Page::context_open();
// echo Invoice::html_row_details($id);
// echo Page::context_close();
// echo Page::body_close();
?>

<style>
    /* body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        } */
    .invoice-container {
        max-width: 800px;
        margin: auto;
        padding: 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #f9f9f9;
    }

    .header,
    .footer {
        text-align: center;
        margin-bottom: 20px;
    }

    .header h1 {
        margin: 0;
    }

    .details,
    .items,
    .summary {
        width: 100%;
        margin-bottom: 20px;
    }

    .details table,
    .items table,
    .summary table {
        width: 100%;
        border-collapse: collapse;
    }

    .details td,
    .items th,
    .items td,
    .summary td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    .items th {
        background-color: #f2f2f2;
    }

    .input-field {
        width: 100%;
        border: none;
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: inherit;
    }
</style>

<div class="invoice-container">
    <div class="header">
        <h1>Hotel Invoice</h1>
        <p>Address: 123 Hotel Street, City, Country</p>
        <p>Phone: +123 456 7890 | Email: contact@hotelname.com</p>
    </div>
    <div class="details">
        <table>
            <tr>
                <td>
                    <p><strong>Invoice No:</strong> <?php echo $invoice->id; ?> </p>
                </td>
                <td>
                    <p><strong> Date:</strong>
                        <?php echo date("F d, Y", strtotime($invoice->created_at)); ?>
                    </p>
                </td>
            </tr>
            <tr>
                <td><strong>Guest Name:</strong> <input type="text" class="input-field" placeholder="Enter Guest Name"></td>
                <td><strong>Room Number:</strong> <input type="text" class="input-field" placeholder="Enter Room Number"></td>
            </tr>
            <tr>
                <td><strong>Check-In:</strong> <input type="date" class="input-field"></td>
                <td><strong>Check-Out:</strong> <input type="date" class="input-field"></td>
            </tr>
        </table>
    </div>
    <div class="items">
        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody id="items-body" class="items-body">
                <tr class="item-row">
                    <td><input type="text" class="input-field item-name" placeholder="Room Charges"></td>
                    <td><input type="number" class="input-field quantity" placeholder="3" oninput="updateTotals()"></td>
                    <td><input type="number" class="input-field unit-price" placeholder="100.00" step="0.01" oninput="updateTotals()"></td>
                    <td class="total">300.00</td>
                </tr>
            </tbody>
        </table>
        <button onclick="addItem()">Add Item</button>
    </div>
    <div class="summary">
        <table>
            <tr>
                <td><strong>Subtotal</strong></td>
                <td id="subtotal">300.00</td>
            </tr>
            <tr>
                <td><strong>Tax (10%)</strong></td>
                <td id="tax">30.00</td>
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td id="grand-total">330.00</td>
            </tr>
        </table>
    </div>
    <div class="footer">
        <p>Thank you for staying with us!</p>
    </div>
</div>
