<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>order-status-change-mail-template</title>
</head>

<body>
<div style="width:800px; margin:auto; background: #f0f0f0; padding: 15px;">
    <table style="width:100%; background: #fff; padding: 15px;">
        <tr>
            <td>
                <h5 style="font-size:25px; color:#000; text-align:center; padding-top: 20px; margin: 0px;">Order Update</h5>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: left; padding: 35px 0px 15px 0px;">
                <img src="https://unifiedvariables.in/dev/samiran/next-episode/frontend/images/next-logo.jpg" style="width:120px;">
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <h5 style="font-size:20px; color:#000; margin-bottom: 15px; margin-top: 0px;">Dear {{$data['order_details']['user_details']['full_name']}},</h5>
                <p style="color: #32353a; font-size: 16px; line-height: 27px; margin-top: 0px; margin-bottom: 5px;"><b>Order Number:</b> {{$data['order_details']['order_number']}}</p>
                <p style="color: #32353a; font-size: 16px; line-height: 27px; margin-top: 0px; margin-bottom: 5px;"><b>Order Date:</b> <?=date('d-m-Y H:i', strtotime($data['order_details']['created_at']))?></p>
                <p style="color: #32353a; font-size: 16px; line-height: 27px; margin-top: 0px; margin-bottom: 5px;"><b>Order Status:</b> <b>{{$data['status']}}</b></p>
                <p style="color: #32353a; font-size: 16px; line-height: 27px; margin-top: 0px; margin-bottom: 5px;">The status of your order has been updated, as shown above. You can check on the status of your order at any time, by going to My Orders in your account.</p>
                
            </td>
        </tr>
    </table>
</div>
</body>
</html>
