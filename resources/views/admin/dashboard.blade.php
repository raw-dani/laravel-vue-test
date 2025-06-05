<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <span class="navbar-brand">Admin Panel</span>
            <div>
                <a href="{{ route('admin.users') }}" class="btn btn-outline-light btn-sm">Users</a>
                <a href="{{ route('admin.system-info') }}" class="btn btn-outline-light btn-sm">System Info</a>
                <form method="POST" action="{{ route('admin.logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Dashboard</h2>
        
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5>Total Users</h5>
                        <h2>{{ $stats['total_users'] }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5>Total Admins</h5>
                        <h2>{{ $stats['total_admins'] }}</h2>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Server Information</h5>
                    </div>
                    <div class="card-body">
                        <p><strong>PHP Version:</strong> {{ $stats['server_info']['php_version'] }}</p>
                        <p><strong>Laravel Version:</strong> {{ $stats['server_info']['laravel_version'] }}</p>
                        <p><strong>Environment:</strong> {{ $stats['server_info']['environment'] }}</p>
                        <p><strong>Server Time:</strong> {{ $stats['server_info']['server_time'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
