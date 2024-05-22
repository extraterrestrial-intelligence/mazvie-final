<?php
global $conn;
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

function isAdmin() {
    return $_SESSION['user']['role_name'] === 'admin';
}

function isTownPlanner() {
    return $_SESSION['user']['role_name'] === 'town_planner';
}

function isEmployee() {
    return $_SESSION['user']['role_name'] === 'employee';
}
include 'config/db_connection.php';

$sql = "SELECT u.user_id, u.username, r.role_name FROM Users u JOIN Roles r ON u.role_id = r.role_id";
$result = $conn->query($sql);

//$sql = "SELECT COUNT(*) as count FROM vehicles";
//$result = $conn->query($sql);
//$vehicles_count = $result->fetch_assoc()['count'];

// Fetch count of users
$sql2 = "SELECT COUNT(*) as count FROM users";
$result = $conn->query($sql2);
$users_count = $result->fetch_assoc()['count'];

//// Fetch count of employees
//$sql = "SELECT COUNT(*) as count FROM employees";
//$result = $conn->query($sql);
//$employees_count = $result->fetch_assoc()['count'];

?>



<!DOCTYPE html>

<html
    lang="en"
    class="light-style layout-menu-fixed layout-compact"
    dir="ltr"
    data-theme="theme-default"
    data-assets-path="../assets/"
    data-template="vertical-menu-template-free">
<head>
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Dashboard - Analytics | Sneat - Bootstrap 5 HTML Admin Template - Pro</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />

    <link rel="stylesheet" href="assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
    <link rel="stylesheet" href="assets/vendor/libs/apex-charts/apex-charts.css" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="assets/vendor/js/helpers.js"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
            <div class="app-brand demo">
                <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSBWtrG9D1_-fyrz8tdqjSuWaGzBa4yI9VCaw&s" width="100">
              </span>
<!--                    <span class="app-brand-text demo menu-text fw-bold ms-2">Sneat</span>-->
                </a>

                <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                    <i class="bx bx-chevron-left bx-sm align-middle"></i>
                </a>
            </div>

            <div class="menu-inner-shadow"></div>

            <ul class="menu-inner py-1">
                <!-- Dashboards -->
                <?php if (isAdmin()) { ?>
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                        <div class="badge bg-danger pil ms-auto">Admin</div>
                    </a>
                </li>

                <!-- Layouts -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-group"></i>
                        <div data-i18n="Layouts">Users</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo htmlspecialchars('view_users.php'); ?>" class="menu-link">
                                <div data-i18n="Without menu">View Users</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Front Pages -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bxs-truck"></i>
                        <div data-i18n="Front Pages">Vehicles</div>

                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a
                                href="<?php echo htmlspecialchars('view_vehicles.php'); ?>"
                                class="menu-link"
                                target="_blank">
                                <div data-i18n="Landing">View Vehicles</div>
                            </a>
                        </li>
                    </ul>
                </li>

                    <li class="menu-item">
                        <a href="<?php echo htmlspecialchars('view_locations.php'); ?>" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-location-plus"></i>
                            <div data-i18n="Front Pages">Location</div>

                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a
                                        href="<?php echo htmlspecialchars('view_vehicles.php'); ?>"
                                        class="menu-link"
                                        target="_blank">
                                    <div data-i18n="Landing">View Vehicles</div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Front Pages -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div data-i18n="Front Pages">Tasks</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a
                                        href="<?php echo htmlspecialchars('view_task.php'); ?>"
                                        class="menu-link"
                                        target="_blank">
                                    <div data-i18n="Landing">View Tasks</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } elseif (isTownPlanner()) { ?>
                <li class="menu-item active open">
                    <a href="#" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                        <div class="badge bg-danger pil ms-auto">Clerk</div>
                    </a>
                </li>

                <!-- Layouts -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-layout"></i>
                        <div data-i18n="Layouts">Users</div>
                    </a>

                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a href="<?php echo htmlspecialchars('view_users.php'); ?>" class="menu-link">
                                <div data-i18n="Without menu">View Users</div>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Front Pages -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-store"></i>
                        <div data-i18n="Front Pages">Vehicles</div>

                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a
                                    href="<?php echo htmlspecialchars('view_vehicles.php'); ?>"
                                    class="menu-link"
                                    target="_blank">
                                <div data-i18n="Landing">View Vehicles</div>
                            </a>
                        </li>
                    </ul>
                </li>
                    <!-- Front Pages -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="menu-icon tf-icons bx bx-store"></i>
                            <div data-i18n="Front Pages">Tasks</div>
                        </a>
                        <ul class="menu-sub">
                            <li class="menu-item">
                                <a
                                        href="<?php echo htmlspecialchars('view_task.php'); ?>"
                                        class="menu-link"
                                        target="_blank">
                                    <div data-i18n="Landing">View Tasks</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                <?php } elseif (isEmployee()) { ?>
                <li class="menu-item active open">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-home-circle"></i>
                        <div data-i18n="Dashboards">Dashboards</div>
                        <div class="badge bg-danger pil ms-auto">Employee</div>
                    </a>
                </li>

                <!-- Front Pages -->
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-store"></i>
                        <div data-i18n="Front Pages">Tasks</div>
                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a
                                    href="<?php echo htmlspecialchars('view_task.php'); ?>"
                                    class="menu-link"
                                    target="_blank">
                                <div data-i18n="Landing">View Tasks</div>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <li class="menu-item">
                    <a href="javascript:void(0);" class="menu-link menu-toggle">
                        <i class="menu-icon tf-icons bx bx-exit"></i>
                        <div data-i18n="Front Pages">Logout</div>

                    </a>
                    <ul class="menu-sub">
                        <li class="menu-item">
                            <a
                                    href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/html/front-pages/landing-page.html"
                                    class="menu-link"
                                    target="_blank">
                                <div data-i18n="Landing">View Vehicles</div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <nav
                class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
                id="layout-navbar">
                <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
                    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                        <i class="bx bx-menu bx-sm"></i>
                    </a>
                </div>

                <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
                    <!-- Search -->
                    <div class="navbar-nav align-items-center">
                        <div class="nav-item d-flex align-items-center">
                            <i class="bx bx-search fs-4 lh-0"></i>
                            <input
                                type="text"
                                class="form-control border-0 shadow-none ps-1 ps-sm-2"
                                placeholder="Search..."
                                aria-label="Search..." />
                        </div>
                    </div>
                    <!-- /Search -->

                    <ul class="navbar-nav flex-row align-items-center ms-auto">
                        <!-- Place this tag where you want the button to render. -->
                        <li class="nav-item lh-1 me-3">
                            <a
                                class="github-button"
                                href="https://github.com/themeselection/sneat-html-admin-template-free"
                                data-icon="octicon-star"
                                data-size="large"
                                data-show-count="true"
                                aria-label="Star themeselection/sneat-html-admin-template-free on GitHub"
                            >Star</a
                            >
                        </li>

                        <!-- User -->
                        <li class="nav-item navbar-dropdown dropdown-user dropdown">
                            <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                                <div class="avatar avatar-online">
                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <div class="d-flex">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar avatar-online">
                                                    <img src="../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <span class="fw-medium d-block">John Doe</span>
                                                <small class="text-muted">Admin</small>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-user me-2"></i>
                                        <span class="align-middle">My Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="bx bx-cog me-2"></i>
                                        <span class="align-middle">Settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                        <span class="d-flex align-items-center align-middle">
                          <i class="flex-shrink-0 bx bx-credit-card me-2"></i>
                          <span class="flex-grow-1 align-middle ms-1">Billing</span>
                          <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">4</span>
                        </span>
                                    </a>
                                </li>
                                <li>
                                    <div class="dropdown-divider"></div>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="bx bx-power-off me-2"></i>
                                        <span class="align-middle">Log Out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <!--/ User -->
                    </ul>
                </div>
            </nav>

            <!-- / Navbar -->

            <!-- Content wrapper -->
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">
                    <div class="row">
                        <div class="col-lg-8 mb-4 order-0">
                            <div class="card">
                                <div class="d-flex align-items-end row">
                                    <div class="col-sm-7">
                                        <div class="card-body">
                                            <h5 class="card-title text-primary">Welcome back <?php echo $_SESSION['user']['username']; ?>! 🎉</h5>
                                        </div>
                                    </div>
                                    <div class="col-sm-5 text-center text-sm-left">
                                        <div class="card-body pb-0 px-0 px-md-4">
                                            <img
                                                src="assets/img/illustrations/man-with-laptop-light.png"
                                                height="140"
                                                alt="View Badge User"
                                                data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="row">
                        <!-- Order Statistics -->
                        <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                    <div class="card-title mb-0">
                                        <h5 class="m-0 me-2">Waste Collection Statistics</h5>
                                    </div>
                                    <div class="dropdown">
                                        <button
                                            class="btn p-0"
                                            type="button"
                                            id="orederStatistics"
                                            data-bs-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="false">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                            <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                                            <a class="dropdown-item" href="javascript:void(0);">Share</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <div class="d-flex flex-column align-items-center gap-1">
                                            <h2 class="mb-2">8</h2>
                                            <span>Total Collections</span>
                                        </div>
                                        <div id="orderStatisticsChart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Order Statistics -->

                        <!-- Expense Overview -->
                        <div class="col-md-6 col-lg-4 order-1 mb-4">
                            <div class="card h-100">
                                <div class="card-header">
                                    <ul class="nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <button
                                                type="button"
                                                class="nav-link active"
                                                role="tab"
                                                data-bs-toggle="tab"
                                                data-bs-target="#navs-tabs-line-card-income"
                                                aria-controls="navs-tabs-line-card-income"
                                                aria-selected="true">
                                                Trends
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body px-0">
                                    <div class="tab-content p-0">
                                        <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel">
                                            <div class="d-flex p-4 pt-3">
                                                <div class="avatar flex-shrink-0 me-3">
                                                    <img src="assets/img/icons/unicons/wallet.png" alt="User" />
                                                </div>
                                                <div>
                                                    <small class="text-muted d-block">Trends</small>
                                                    <div class="d-flex align-items-center">
                                                        <h6 class="mb-0 me-1">45</h6>
                                                        <small class="text-success fw-medium">
                                                            <i class="bx bx-chevron-up"></i>
                                                            42.9%
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="incomeChart"></div>
                                            <div class="d-flex justify-content-center pt-4 gap-2">
                                                <div class="flex-shrink-0">
                                                    <div id="expensesOfWeek"></div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- / Content -->

                <!-- Footer -->
                <footer class="content-footer footer bg-footer-theme">
                    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
                        <div class="mb-2 mb-md-0">
                            ©
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
                            , made with ❤️ by
                            <a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">ThemeSelection</a>
                        </div>
                        <div class="d-none d-lg-inline-block">
                            <a href="https://themeselection.com/license/" class="footer-link me-4" target="_blank">License</a>
                            <a href="https://themeselection.com/" target="_blank" class="footer-link me-4">More Themes</a>

                            <a
                                href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
                                target="_blank"
                                class="footer-link me-4"
                            >Documentation</a
                            >

                            <a
                                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"
                                target="_blank"
                                class="footer-link"
                            >Support</a
                            >
                        </div>
                    </div>
                </footer>
                <!-- / Footer -->

                <div class="content-backdrop fade"></div>
            </div>
            <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
    </div>

    <!-- Overlay -->
    <div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<div class="buy-now">
    <a
        href="https://themeselection.com/item/sneat-bootstrap-html-admin-template/"
        target="_blank"
        class="btn btn-danger btn-buy-now"
    >Upgrade to Pro</a
    >
</div>

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<script src="assets/vendor/libs/jquery/jquery.js"></script>
<script src="assets/vendor/libs/popper/popper.js"></script>
<script src="assets/vendor/js/bootstrap.js"></script>
<script src="assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>

<!-- Page JS -->
<script src="assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>