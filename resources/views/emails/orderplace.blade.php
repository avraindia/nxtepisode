<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>order-place-mail-template</title>
</head>

<body>
<div style="width:800px; margin:auto; background: #f0f0f0; padding: 15px;">
    <h5 style="font-size:20px; color:#000; text-align:center; margin:0; background: #e11b23; padding: 10px 0px; color: #fff;">Thank you for your order</h5>
    <table style="width:100%; background: #fff; padding: 15px;">
        <tr>
            <td>
                <img src="https://unifiedvariables.in/dev/samiran/next-episode/frontend/images/next-logo.jpg" style="width:120px;">
                <p style="font-size:14px; color:#000; line-height: 20px;">
                   <b>NXT episode</b><br>
                   Malad (West), Mumbai: 400 064<br>
                   Email: contact@nextepisode.com<br>
                   Phone: +91 123456789, +91 123456789
                </p>
            </td>
            <td>
                <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">BILL No. #{{$data['order_details']['order_number']}}</p>
                <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">DATED: <?=date('d-m-Y', strtotime($data['order_details']['created_at']))?></p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="font-size:13px; color:#000;">
                  <tr>
                      <th colspan="2" style="background-color:#e11b23; padding:3px 5px; font-size:15px; color:#fff;">DELIVERY ADDRESS</th>
                  </tr>
                  <tr>
                      <th style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">NAME </th>
                      <td style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">{{$data['order_details']['shipping_address']['first_name']}} {{$data['order_details']['shipping_address']['last_name']}}</td>
                  </tr>
                  <tr>
                      <th style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">ADDRESS</th>
                      <td style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">
                      {{$data['order_details']['shipping_address']['house_no']}} {{$data['order_details']['shipping_address']['street_name']}}, {{$data['order_details']['shipping_address']['landmark']}}, {{$data['order_details']['shipping_address']['city_district']}}, {{$data['order_details']['shipping_address']['state_name']}}, {{$data['order_details']['shipping_address']['country']}}, {{$data['order_details']['shipping_address']['postal_code']}}
                      </td>
                  </tr>
                  <tr>
                      <th style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">EMAIL</th>
                      <td style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">{{$data['order_details']['user_details']['email']}}</td>
                  </tr>
                  <tr>
                      <th style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">PHONE</th>
                      <td style="vertical-align: top; text-align: left; padding:2px 10px 2px 5px;">+91 {{$data['order_details']['user_details']['phone_number']}} </td>
                  </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table style="width: 100%; margin-top: 40px;">
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
        <tr>
            <td colspan="2">
                <p style="font-size:14px; font-weight:bold; color:#000; line-height: 20px;">
                Thank you for choosing NXT episode.<br>
                We are happy to serve you again.
                </p>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p style="font-size:12px; font-weight:500; color:#000; line-height: 20px;">
                    This is electronically generated bill and does not require any stamp or signature.
                </p>
            </td>
        </tr>
        <tr>
            <td width="50%">
               <div style="width:100%; height:7px; background:#117a7a;"></div>
            </td>
            <td width="50%" style="font-size:25px; color:#282828;">Uniques for you</td>
        </tr>
    </table>
</div>
</body>
</html>
