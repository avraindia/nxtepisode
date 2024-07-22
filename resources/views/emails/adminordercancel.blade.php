<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="content-language" content="en-us">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <title>order-cancel-mail-template</title>
</head>

<body>
    <div style="width:800px; margin:auto; background: #f0f0f0; padding: 15px;">
        <table style="width:100%; background: #fff; padding: 15px;">
            <tr>
                <td>
                    <img src="https://unifiedvariables.in/dev/samiran/next-episode/frontend/images/next-logo.jpg" style="width:120px;">
                </td>
                <td>
                    <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">ORDER No. #{{$data['order_details']['order_number']}}</p>
                    <p style="font-size:15px; color:#000; font-weight: 600; text-align: right;">DATED: <?=date('d-m-Y', strtotime($data['order_details']['created_at']))?></p>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <h5 style="font-size:25px; color:#000; text-align:left; padding-top: 20px; margin: 0px;">Your order
                        has been cancelled!</h5>
                    <p style="color: #32353a; font-size: 16px; line-height: 27px;">Order request for #{{$data['order_details']['order_number']}} has been cancelled by site admin. Hope for your successfull next order.</p>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>