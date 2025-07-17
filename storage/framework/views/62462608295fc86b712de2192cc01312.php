<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $__env->yieldContent('title', 'My Laravel App'); ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#">Laravel Blade Layout</a>
            </div>
            <div class="navbar-brand">
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-link nav-link"
                    style="padding-right:70px;">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        <?php echo $__env->yieldContent('content'); ?> <!-- Dynamic content will be injected here -->
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            &copy; <?php echo e(date('Y')); ?> My Laravel App
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?> <!-- For additional page-specific scripts -->
</body>
</html><?php /**PATH C:\Users\Ahmad\Desktop\1\new\resources\views\layouts\app.blade.php ENDPATH**/ ?>