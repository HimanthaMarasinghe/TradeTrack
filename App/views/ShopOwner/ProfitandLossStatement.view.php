<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profit and Loss Statement</title>
    <style>
        :root{
            --primary-color: #162359; 
        }

        body {
            font-family: Arial, sans-serif;
            padding: 0;
            color: #333;
            background-color: #f9f9f9;
        }

        * {
            margin: 0;
            box-sizing: border-box;
        }

        .report-container {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            margin-bottom: 20px;
        }

        header h1 {
            margin: 0;
            font-size: 24px;
            color: #555;
        }

        header p {
            margin: 5px 0;
            font-size: 14px;
        }

        .statement h2, .owner-equity h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #444;
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table th, table td {
            padding: 8px 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background: #f4f4f4;
            font-weight: bold;
        }

        .section-header td {
            background: #e9ecef;
            font-weight: bold;
            text-transform: uppercase;
        }

        footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            margin-top: 20px;
        }

        .asp-rtio {
            aspect-ratio: 1;
        }

        .profile-photo {
            height: 90px;
            width: 90px;

            & img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
            }
        }

        .colomn {
            display: flex;
            flex-direction: column;
        }

        @media print {
            body {
                background: none;
            }
            .report-container {
                box-shadow: none;
                border: none;
            }
        }
    </style>
    <link rel="stylesheet" href="<?=ROOT?>/css/notification.css">
    </head>
    <body>
        <div class="report-container">
            <header>
                <h1>Shop Name</h1>
                <p>Profit and Loss Statement</p>
                <p>For the Period: 01 Nov 2024 - 15 Nov 2024</p>
            </header>

            <section class="statement">
                <h2>Profit and Loss Statement</h2>

                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Revenue Section -->
                        <tr class="section-header">
                            <td colspan="2"><strong>Revenue</strong></td>
                        </tr>
                        <tr>
                            <td>Total Sales</td>
                            <td>200,000</td>
                        </tr>

                        <!-- Cost of Goods Sold -->
                        <tr class="section-header">
                            <td colspan="2"><strong>Cost of Goods Sold</strong></td>
                        </tr>
                        <tr>
                            <td>Cost of Purchases</td>
                            <td>(150,000)</td>
                        </tr>

                        <!-- Gross Profit -->
                        <tr class="section-header">
                            <td colspan="2"><strong>Gross Profit</strong></td>
                        </tr>
                        <tr>
                            <td>Gross Profit</td>
                            <td>50,000</td>
                        </tr>

                        <!-- Expenses Section -->
                        <tr class="section-header">
                            <td colspan="2"><strong>Operating Expenses</strong></td>
                        </tr>
                        <tr>
                            <td>Other Expenses (e.g., Utilities)</td>
                            <td>(10,000)</td>
                        </tr>

                        <!-- Net Profit -->
                        <tr class="section-header">
                            <td colspan="2"><strong>Net Profit</strong></td>
                        </tr>
                        <tr>
                            <td>Profit Before Taxes</td>
                            <td>40,000</td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <section class="owner-equity">
                <h2>Statement of Owner's Equity</h2>
                <table>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Amount (Rs.)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Initial Capital</td>
                            <td>500,000</td>
                        </tr>
                        <tr>
                            <td>Add: Net Profit</td>
                            <td>40,000</td>
                        </tr>
                        <tr>
                            <td>Less: Withdrawals</td>
                            <td>(20,000)</td>
                        </tr>
                        <tr class="section-header">
                            <td><strong>Closing Capital</strong></td>
                            <td><strong>520,000</strong></td>
                        </tr>
                    </tbody>
                </table>
            </section>

            <footer>
                <p>Generated on: 20 Nov 2024</p>
            </footer>
        </div>
        <div id="notification-container"></div>
    </body>

    <script>
        const ROOT = "<?=ROOT?>";
        const LINKROOT = "<?=LINKROOT?>"
        const ws_id = "<?=$_SESSION['shop_owner']['phone']?>";
        const ws_token = "<?=$_SESSION['web_socket_token']?>";
    </script>

    <script src="<?=ROOT?>/js/notificationConfig.js" type="module"></script>
</html>
