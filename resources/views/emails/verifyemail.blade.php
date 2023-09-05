<!DOCTYPE html>
<html lang="en-US">
  <head>
    <meta charset="utf-8" />
  </head>
  <body>
    <h2>OTP for Verify Email</h2>
    <p>Hello {{ $data['user_name'] }}, Your email verification OTP is {{ $data['OTP'] }}. Use this OTP to Verify your Email.</p>
  </body>
</html>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Verification Code Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .content {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
        }

        h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        p {
            margin-top: 0;
            margin-bottom: 10px;
        }

        .code {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="content">
            <h2>Verification Code</h2>
            <p>Hello {{ $data['user_name'] }}, Please use the verification code below to sign in.</p>
            <p class="code">{{ $data['OTP'] }}</p>
            <p>If you didn’t request this, you can ignore this email.</p>
            <p>Thanks,<br>
                Citybot team</p>
        </div>
    </div>
</body>

</html>
