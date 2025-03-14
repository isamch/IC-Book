<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        /* General body styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container for the content */
        .container {
            background: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.1);
            max-width: 500px;
            width: 100%;
            text-align: center;
        }

        /* Header styling */
        h2 {
            color: #343a40;
            font-size: 24px;
            margin-bottom: 15px;
        }

        /* Paragraph styling */
        p {
            color: #6c757d;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 25px;
        }

        /* Verify button styling */
        .btn-verify {
            display: inline-block;
            padding: 12px 30px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .btn-verify:hover {
            background-color: #218838;
        }

        /* Link styling for the verification URL */
        .verification-link {
            display: block;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
            font-size: 14px;
            word-break: break-all;
        }

        .verification-link:hover {
            text-decoration: underline;
        }

        /* Footer styling */
        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #6c757d;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Welcome, {{ $user->first_name }}</h2>

        <p>Thank you for signing up! Please click the button below to verify your email address and activate your
            account.</p>

        <a href="{{ url('/email/verify/' . $user->id . '/' . $user->verification_token) }}" class="btn-verify">
            Verify Email
        </a>

        <a href="{{ url('/email/verify/' . $user->id . '/' . $user->verification_token) }}" class="verification-link">
            {{ url('/email/verify/' . $user->id . '/' . $user->verification_token) }}
        </a>

        <div class="footer">
            If you did not create an account, no further action is required.
        </div>
    </div>

</body>

</html>
