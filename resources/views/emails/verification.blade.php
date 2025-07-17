<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .email-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .email-body {
            padding: 30px;
        }
        .verification-code {
            background-color: #f1f8ff;
            border-left: 4px solid #2575fc;
            padding: 15px;
            margin: 20px 0;
            font-size: 24px;
            font-weight: bold;
            color: #2575fc;
            text-align: center;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            font-size: 14px;
            color: #666;
        }
        .btn-primary {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Welcome to Our Application</h1>
            <p class="mb-0">We're thrilled to have you join our community</p>
        </div>
        
        <div class="email-body">
            <h2 class="mb-4">Hello {{$user->firstname}} {{$user->lastname}},</h2>
            
            <p class="lead">Thank you for registering with us. We're excited to have you on board!</p>
            
            <p>To complete your registration, please use the following verification code:</p>
            
            <div class="verification-code">
                {{$user->verification_code}}
            </div>
            
            <p class="mt-4">This code will expire in 24 hours. If you didn't request this, please ignore this email.</p>
            
            <!-- <div class="text-center mt-4">
                <a href="#" class="btn btn-primary">Go to Our Website</a>
            </div> -->
        </div>
        
        <div class="footer">
            <p class="mb-1">Best regards,</p>
            <p class="mb-0">Your Application Team</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>