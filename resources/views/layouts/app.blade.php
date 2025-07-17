<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" />
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container  pr-3">
                <a class="navbar-brand" href="#">DashBoard</a>
            </div>
            <div style="display: flex; width:50%; gap:50px;">
                <a class="navbar-brand" href="{{ route('admin.dashboard')}}">Channels</a>
                <a class="navbar-brand" href="{{ route('verifiedusers')}}">Verified Users</a>
                <a class="navbar-brand" href="{{ route('allusers')}}">All Users</a>
            </div>
            <div class="navbar-brand">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link"
                    style="padding-right:70px;">Logout</button>
                </form>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container mt-4">
        @yield('content') <!-- Dynamic content will be injected here -->
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            &copy; {{ date('Y') }} My Laravel App
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts') <!-- For additional page-specific scripts -->
</body>
</html>