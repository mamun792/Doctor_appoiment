<!DOCTYPE html>
<html>
<head>
    <title>Payment Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            margin-bottom: 10px;
            color: #555;
        }

        .details {
            margin-top: 30px;
        }

        .details p {
            margin-bottom: 5px;
        }

        .signature {
            margin-top: 30px;
            font-style: italic;
            color: #888;
        }

        .signature p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Successful</h1>
        <p>Dear ,{{ $appointment->relationInvoiceList->name}}</p>
        <p>Your payment has been successfully processed.</p>

        <div class="details">
            <h2>Appointment Details:</h2>
            <p>Doctor: {{ $appointment->relationInvoiceDoctor->fname }} {{ $appointment->relationInvoiceDoctor->lname }}</p>
            <p>Date: {{ $appointment->appioment_date }}</p>
            <p>Time: {{ $appointment->appioment_time }}</p>
        </div>

        <p>Thank you for using our service.</p>

        <div class="signature">
            <p>Best regards,</p>
            <p>{{ env('APP_NAME') }}</p>
        </div>
    </div>
</body>
</html>
