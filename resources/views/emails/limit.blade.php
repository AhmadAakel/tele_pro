<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Channel Notification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .notification-container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .notification-header {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            color: white;
            padding: 25px;
            text-align: center;
        }
        .notification-body {
            padding: 30px;
            text-align: center;
        }
        .alert-icon {
            font-size: 48px;
            color: #ff4b2b;
            margin-bottom: 20px;
        }
        .action-btn {
            background: linear-gradient(135deg, #ff416c 0%, #ff4b2b 100%);
            border: none;
            padding: 10px 25px;
            font-weight: 500;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f1f1f1;
            font-size: 14px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="notification-container">
        <div class="notification-header">
            <h2>Channel Limit Reached</h2>
        </div>
        
        <div class="notification-body">
            <div class="alert-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </svg>
            </div>
            <h3 class="mb-4">Your channel has reached its limit</h3>
            <p class="lead">Please change your channel URL to continue accessing all features.</p>
            
            <!-- <a href="#" class="btn action-btn text-white">Change Channel URL</a> -->
        </div>
        
        <div class="footer">
            <p class="mb-0">Need help? Contact our support team</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>