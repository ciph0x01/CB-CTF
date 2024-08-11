<?php

echo '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Business Invoice Generator</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background: #f4f4f4;
        color: #333;
    }
    .header {
        background-color: #007bff;
        color: #fff;
        padding: 20px;
        text-align: center;
    }
    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
        margin-top: 0;
    }
    input[type="text"], input[type="submit"] {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    input[type="submit"] {
        background-color: #007bff;
        color: #fff;
        border: none;
        cursor: pointer;
    }
    input[type="submit"]:hover {
        background-color: #0056b3;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 12px;
        text-align: left;
    }
    th {
        background-color: #f4f4f4;
    }
    tfoot th {
        text-align: right;
    }
    a {
        color: #007bff;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
    .website-table td, .website-table th {
        border: none;
        padding: 10px;
    }
</style>
</head>
<body>

<div class="header">
    <h1>Business Invoice Generator</h1>
    <p>Create professional invoices for your customers.</p>
</div>

<div class="container">
    <form method="post">
        <h2>Generate Invoice</h2>
        <label for="handle">Customer Name:</label>
        <input type="text" id="handle" name="handle" required>
        
        <label for="website">Website:</label>
        <input type="text" id="website" name="website" placeholder="http://example.com" required>
        
        <input type="submit" name="insert" value="Generate Invoice">
    </form>
</div>

';

if (isset($_POST['insert'])) {

    $customerName = $_POST['handle'];
    $website = $_POST['website'];

    // Fetch content from the provided website URL
    $fetchedContent = @file_get_contents($website);

    // Generate HTML content for the PDF
    $html = '
    <html>
    <head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tfoot th {
            text-align: right;
        }
        .website-table {
            width: 100%;
            border-collapse: collapse;
        }
        .website-table td, .website-table th {
            border: none;
            padding: 10px;
        }
    </style>
    </head>
    <body>
    <h2>Invoice #123456789</h2>
    <table>
        <thead>
            <tr>
                <th colspan="2">Pay to:</th>
                <th colspan="2">Customer:</th>
            </tr>
            <tr>
                <td colspan="2">
                    <strong>Acme Billing Co.</strong><br>
                    123 Main St.<br>
                    Cityville, NA 12345
                </td>
                <td colspan="2">
                    <strong>' . $customerName . '</strong><br>
                    321 Willow Way<br>
                    Southeast Northwestershire, MA 54321
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>Name / Description</th>
                <th>Qty.</th>
                <th>@</th>
                <th>Cost</th>
            </tr>
            <tr>
                <td>Paperclips</td>
                <td>1000</td>
                <td>0.01</td>
                <td>10.00</td>
            </tr>
            <tr>
                <td>Staples (box)</td>
                <td>100</td>
                <td>1.00</td>
                <td>100.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <th colspan="3">Subtotal</th>
                <td>110.00</td>
            </tr>
            <tr>
                <th colspan="2">Tax (8%)</th>
                <td>8.80</td>
            </tr>
            <tr>
                <th colspan="3">Grand Total</th>
                <td>118.80</td>
            </tr>
        </tfoot>
    </table>
    <table class="website-table">
        <tr>
            <th>Website:</th>
            <td>' . $fetchedContent . '</td>
        </tr>
    </table>
    </body>
    </html>';

    // Save HTML to a file and generate PDF
    file_put_contents('invoice.html', $html);
    passthru('weasyprint invoice.html invoice.pdf 2>&1');

    // Display download link
    echo '<div class="container">
        <h2>Invoice Generated</h2>
        <p>Hello ' . $customerName . ', please download your invoice using the link below:</p>
        <p><a href="invoice.pdf">Download Invoice</a></p>
    </div>';
}

?>
