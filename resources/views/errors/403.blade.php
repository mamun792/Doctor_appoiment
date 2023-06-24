<!DOCTYPE html>
<html>

<head>
    <title>403 - Unauthorized</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 40px;
            text-align: center;
        }

        .error-code {
            font-size: 72px;
            font-weight: bold;
            color: #e74c3c;
            margin: 0;


            color: #00d0f1;
            font-size: 10em;
        }


        .error-message {
            font-size: 24px;
            color: #333;
            margin-bottom: 30px;
        }

        .home-link {
            font-size: 28px;
            background-color: #00d0f1;
            border: 1px solid #00d0f1;
            text-decoration: none;
            border-radius: 50px;
            font-size: 18px;
            font-weight: 600;
            min-width: 200px;
            padding: 10px 20px;
        }

        /* .home-link:hover {
            text-decoration: underline;
        } */
    </style>
</head>

<body>
    <div class="container">
        <h1 class="error-code">403</h1>
        <p class="error-message">Oops! You are not authorized to access this page.</p>
        <a class="home-link" href="{{ url('/') }}">Go to Home</a>
    </div>
</body>

</html>
