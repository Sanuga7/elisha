<?php

function getActiveClass1($uri)
{
    $currentFile = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
    return ($currentFile == $uri) ? 'active' : '';
}


?>
<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elisha Creation || Admin Panel</title>
    <link rel="shortcut icon" href="assets/images/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
        body {
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            height: 100%;
            position: fixed;
            width: 250px;
            top: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0 0;
            background-color: #343a40;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar.collapsed .nav-link .nav-text,
        .sidebar.collapsed .brand-text {
            display: none;
        }

        .sidebar.collapsed .brand {
            justify-content: center;
        }

        .sidebar-sticky {
            height: calc(100vh - 48px);
            display: flex;
            flex-direction: column;
        }

        .nav-link {
            font-size: 1rem;
            color: #cdd3d8;
            padding: 10px 20px;
        }

        .nav-link .nav-text {
            margin-left: 10px;
        }

        .nav-link.active,
        .nav-link:hover {
            background-color: #007bff;
            color: #ffffff !important;
        }

        .sidebar-heading {
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-top: 1rem;
            color: #cdd3d8;
        }

        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: calc(100% - 250px);
            background-color: #f8f9fa;
            color: #000;
            overflow-y: auto;
            transition: all 0.3s;
        }

        .main-content.collapsed {
            margin-left: 80px;
            width: calc(100% - 80px);
        }

        .brand {
            display: flex;
            align-items: center;
            color: white;
            text-decoration: none;
            padding-bottom: 20px;
            font-weight: bold;
            font-size: 1.5rem;
            justify-content: center;
        }

        .brand span {
            color: #007bff;
        }

        .logout {
            margin-top: auto;
            padding: 10px 20px;
        }

        .navbar {
            position: fixed;
            top: 0;
            width: calc(100% - 250px);
            margin-left: 250px;
            z-index: 101;
            transition: all 0.3s;
            background-color: #343a40;
            padding: 10px;
        }

        .navbar.collapsed {
            width: calc(100% - 80px);
            margin-left: 80px;
        }

        .search-bar {
            width: 300px;
            margin: 0 auto;
        }

        .navbar-nav .nav-item .nav-link {
            color: #fff;
        }

        .collapse-button {
            color: #fff;
            background: none;
            border: none;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Side Navbar -->
    <nav id="sidebarMenu" class="sidebar">
        <div class="sidebar-sticky d-flex flex-column">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="brand navbar-brand d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                        <i class="fa-solid fa-cube" style="overflow-y: hidden;"></i><span class="brand-text text-light fs-4">Elisha</span><span class="brand-text" style="color: #007bff;">.</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('dashboard.php'); ?>" aria-current="page" href="dashboard.php"><i class="me-2 fa-solid fa-tachometer-alt"></i><span class="nav-text">Dashboard</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('manageusers.php'); ?>" href="manageusers.php"><i class="me-2 fa-solid fa-users"></i><span class="nav-text">Users</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('manageproduct.php'); ?>" href="manageproduct.php"><i class="me-2 fa-solid fa-box"></i><span class="nav-text">Products</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('addproduct.php'); ?>" href="addproduct.php"><i class="me-2 fa-solid fa-plus"></i><span class="nav-text">Add Products</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('managepromocodes.php'); ?>" href="managepromocodes.php"><i class="me-2 fa-solid fa-tag"></i><span class="nav-text">Promo Codes</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('orders.php'); ?>" href="orders.php"><i class="me-2 fa-solid fa-receipt"></i><span class="nav-text">Orders</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link fs-6 <?php echo getActiveClass1('massage.php'); ?>" href="massage.php"><i class="me-2 fa-solid fa-envelope"></i><span class="nav-text">Messages</span></a>
                </li>
            </ul>
            <div class="logout nav-item mt-auto">
                <a class="nav-link fs-6" href="logout.php"><i class="me-2 fa-solid fa-sign-out-alt"></i><span class="nav-text">Logout</span></a>
            </div>
        </div>
    </nav>

    <!-- Top Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <button class="collapse-button" onclick="toggleSidebar()"><i class="fa-solid fa-bars"></i></button>
        <ul class="navbar-nav ms-auto">
            
        </ul>
    </nav>



    <script>
        function toggleSidebar() {
            document.getElementById('sidebarMenu').classList.toggle('collapsed');
            document.querySelector('.main-content').classList.toggle('collapsed');
            document.querySelector('.navbar').classList.toggle('collapsed');
        }
    </script>
    <script src="assets/js/script.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>