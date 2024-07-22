<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="en-us">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>exchange-order-mail-template</title>
</head>

<body>
    <div style="width:800px; margin:auto; background: #f0f0f0; padding: 15px;">
        <table style="width:100%; background: #fff; padding: 15px;">
            <tr>
                <td>
                    <img src="https://unifiedvariables.in/dev/samiran/next-episode/frontend/images/next-logo.jpg" style="width:120px;">
                </td>
                <td>
                    <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">BILL No. #{{$data['order_details']['order_number']}}</p>
                    <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">DATED: <?=date('d-m-Y', strtotime($data['order_details']['created_at']))?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h5 style="font-size:25px; color:#000; text-align:left; padding-top: 20px; margin: 0px;">Your order
                        has been exchanged</h5>
                    <p style="color: #32353a; font-size: 16px; line-height: 27px;">Your exchange request for #{{$data['parent_order_details']['order_number']}} has been successfully processed. Please let us know the reason for the exchange to
                        help us improve your experience in the future.</p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h5 style="font-size:25px; color:#000; text-align:left; margin: 0px;">Exchange Items:</h5>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table style="width: 100%; margin-top: 11px;">
                        <thead>
                            <tr style="background-color:#e11b23; font-size: 12px; color:#fff;">
                                <th style="padding:4px;">#</th>
                                <th style="padding:4px;">PRODUCT NAME</th>
                                <th style="padding:4px;">FITTING</th>
                                <th style="padding:4px;">SIZE</th>
                                <th style="padding:4px;">QTY</th>
                                <th style="padding:4px;">UNIT COST</th>
                                <th style="padding:4px;">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody style="font-size:13px; color:#000;">
                            <?php
                            $order_items = $data['order_details']['order_items'];
                            $count = 1;
                            foreach($order_items as $key=>$order_item){
                                ?>
                                <tr>
                                    <td style="padding:4px;"><?=$count?></td>
                                    <td style="padding:4px;"><?=$order_item['product_name']?></td>
                                    <td style="padding:4px;"><?=$order_item['fitting_type']?></td>
                                    <td style="padding:4px;"><?=$order_item['size_name']?></td>
                                    <td style="padding:4px; text-align: right;"><?=$order_item['quantity']?></td>
                                    <td style="padding:4px; text-align: right;"><?=$order_item['sell_price']?></td>
                                    <td style="padding:4px; text-align: right;"><?=$order_item['total_price']?></td>
                                </tr>
                                <?php
                                $count++;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" style="vertical-align: top;">
                                    <table border="0" cellspacing="0" style="margin-top:40px; width:100%;">
                                        <tr style="background-color:#e11b23; font-size: 12px; color:#fff;">
                                            <th style="padding:4px;">NOTES</th>
                                        </tr>
                                        <tr>
                                            <td style="border:1px solid #ccc; padding:8px;">
                                                <p style="min-height:123px; margin: 0;">
                                                - Order placed successfully. You will be notified updates via email.<br>
                                                - Amount mentioned is inclusive of all taxes (as applicable)
                                                </p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td colspan="3" style="vertical-align: top;">
                                    <table border="0" cellspacing="0" style="margin-top:40px; width:100%; font-size:13px; color:#000;">
                                        <tr>
                                            <td style="padding:4px;">SUBTOTAL</td>
                                            <td style="padding:4px; text-align: right;">₹ {{$data['order_details']['order_price']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:4px;">SHIPPING</td>
                                            <td style="padding:4px; text-align: right;">₹ {{$data['order_details']['shipping_fee']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:4px;">DISCOUNT</td>
                                            <td style="padding:4px; text-align: right;">- ₹ {{$data['order_details']['discount']}}</td>
                                        </tr>
                                        <tr>
                                            <td style="padding:4px; font-weight: bold; font-size: 17px;">GRAND TOTAL</td>
                                            <td style="padding:4px; text-align: right; font-weight: bold; font-size: 17px;">₹ {{$data['order_details']['final_price']}}</td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </tfoot>
                    </table>    
                </td>
            </tr>
        </table>
    </div>
</body>

</html>