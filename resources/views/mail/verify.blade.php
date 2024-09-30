<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        table {
            border-spacing: 0;
        }

        img {
            border: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #003366;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .content {
            padding: 20px;
            color: #333333;
        }

        .content h2 {
            margin-top: 0;
            color: #003366;
        }

        .content p {
            line-height: 1.6;
            font-size: 16px;
        }

        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 20px 0;
            background-color: #003366;
            color: #000000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 4px;
        }

        .btn:hover {
            background-color: #0033aa;
        }

        .footer {
            background-color: #f4f4f4;
            padding: 20px;
            text-align: center;
            color: #777777;
            font-size: 12px;
        }

        .footer p {
            margin: 0;
        }

        .footer a {
            color: #000000;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 600px) {
            .container {
                width: 100% !important;
            }

            .content p {
                font-size: 14px;
            }

            .header h1 {
                font-size: 20px;
            }
        }
    </style>
</head>

<body>
    <table role="presentation" width="100%" bgcolor="#f4f4f4">
        <tr>
            <td align="center">
                <div class="container">
                    <!-- Header -->
                    <div class="header">
                        <h1>Welcome to Our Service</h1>
                    </div>

                    <!-- Content -->
                    <div class="content">
                        <h2>Hello,{{ $user['name'] }}</h2>
                        <p>Thank you for joining our service. We're thrilled to have you on board!</p>
                        <p>To get started, please click the button below:</p>
                        <a href="{{ route('verify.email', $user['id']) }}" class="btn"
                            style="color: rgb(249, 245, 245)">Verify
                            Email</a>
                        <p>If you have any questions, feel free to reach out to our support team.</p>
                    </div>

                    <!-- Footer -->
                    <div class="footer">
                        <p>&copy; 2024 Your Company. All rights reserved.</p>
                        <p><a href="#">Unsubscribe</a></p>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</body>

</html>
