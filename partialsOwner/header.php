<header id="header" class="header fixed-top d-flex align-items-center">
    <!-- Logo Start -->
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            <img src="../assets/img/logo.png" alt="logo">
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- Logo End -->
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item dropdown pe-3">
                <!-- Profile Image Start -->
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                    <?php
                    if (empty($_SESSION['profile_owner'])) {
                        echo '<img width="35" src="../assets/img/User.png" />';
                    } else {
                        echo '<img src="img/' . $_SESSION['profile_owner'] . '" class="rounded-circle" width="40" height="100">';
                    }
                    ?>
                    <span class="d-none d-md-block dropdown-toggle ps-2"><?= $_SESSION['name_owner'] ?></span>
                </a>
                <!-- Profile Image End -->
                <!-- Profile Dropdown Start -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6><?= $_SESSION['name_owner'] ?></h6>
                        <span>Owner</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../owner/profile.php">
                            <i class="bi bi-person"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
                <!-- Profile Dropdown End -->
            </li>
        </ul>
    </nav>
</header>