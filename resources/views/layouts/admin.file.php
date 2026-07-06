<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: #f4f6f9;
        }

        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #1e293b;
            color: white;
        }

        .sidebar a {
            color: #cbd5e1;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
        }

        .sidebar a:hover {
            background: #334155;
            color: white;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .brand {
            font-size: 20px;
            font-weight: bold;
            padding: 20px;
            border-bottom: 1px solid #334155;
        }

        .active {
            background: #334155;
            color: white;
        }
    </style>
</head>
<body>

    <!-- SIDEBAR -->
    <div class="sidebar">
        <div class="brand">
            Admin Panel
        </div>

        <a href="#" class="active">🏠 Dashboard</a>
        <a href="#">👨‍🎓 Mahasiswa</a>
        <a href="#">📚 Mata Kuliah</a>
        <a href="#">📝 Nilai</a>
        <a href="#">⚙️ Settings</a>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

</body>
</html>