<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="content-language" content="en-us">
<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

<title>registration-mail-template</title>
</head>

<body>
<div style="width:800px; margin:auto; background: #f0f0f0; padding: 15px;">
    <table style="width:100%; background: #fff; padding: 15px;">
        <tr>
            <td>
                <h5 style="font-size:25px; color:#000; text-align:center; padding-top: 20px; margin: 0px;">Welcome</h5>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: center; padding: 35px 0px;">
                <img src="https://unifiedvariables.in/dev/samiran/next-episode/frontend/images/next-logo.jpg" style="width:120px;">
            </td>
        </tr>
        <tr colspan="2">
            <td>
                <h5 style="font-size:20px; color:#000; margin-bottom: 15px;">Hello {{$data['user_name']}},</h5>
                <p style="color: #32353a; font-size: 16px; line-height: 27px;">Thanks for joining. We're really excited to have you on board. Lorem ipsum dolor, sit amet consectetur adipisicing elit. Commodi necessitatibus debitis repudiandae quibusdam omnis nisi impedit quaerat? Suscipit nulla aliquam vitae sed! In saepe, nulla enim illum voluptatum est sunt.</p>
            </td>
        </tr>
        <tr colspan="2" style="text-align: center;">
            <td>
                <a style="display: inline-block; margin-top: 20px; background: #117a7a; color: #fff; padding: 10px 15px;     text-transform: uppercase; font-weight: 600; text-decoration: none;" href="{{env('APP_URL')}}">LOGIN TO YOUR ACCOUNT</a>
            </td>
        </tr>
    </table>
</div>
</body>
</html>
