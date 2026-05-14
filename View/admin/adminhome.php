<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="styles/admindashboard.css">
</head>
    <body>
        <!-- SIDEBAR -->
        <aside id="sidebar">
        <div class="logo">Moonlight Dashboard</div>
            <?php include 'sidebar.php'; ?>
        </aside>

        <!-- MAIN -->
        <div id="main">
        <div id="topbar">
            <h1 id="page-title">Dashboard</h1>
            <span class="user">Dashboard</span>
        </div>

        <div id="content">
            <div id="loading"></div>
            <div id="page-content">
            <?php include 'pages/Dashboard.php'; ?>
            </div>
        </div>
        </div>

        <script src="../../Assets/js/sidebar.js"></script>
    </body>
</html>
