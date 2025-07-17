<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome to Our Application</h1>
        <h1>Hello <?php echo e($user->firstname); ?> <?php echo e($user->lastname); ?> ,</h1>
        
        <h3>Thank you for registering with us. We're excited to have you on board!</h3>
        <h3>your verification code: <?php echo e($user->verification_code); ?></h3>
        <p>Best regards,</p>
        <p>Your Application Team</p>
</body>
</html><?php /**PATH D:\1\new\resources\views/emails/verification.blade.php ENDPATH**/ ?>