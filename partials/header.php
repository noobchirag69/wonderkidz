<style>
    .container-fluid a {
        text-decoration: none;
    }
</style>

<nav class="navbar bg-primary">
    <div class="container-fluid px-3">
        <div class="d-flex align-items-center">
            <img id="logo" src="http://localhost/wonderkidz/assets/logo.png" alt="Logo">
            <span>&nbsp;&nbsp;</span>
            <a href="http://localhost/wonderkidz/">
                <span class="navbar-brand mb-0 h1 text-white">WonderKidz</span>
            </a>
        </div>
        <div>
            <?php if (isset($_SESSION['id'])) {
                if ($_SESSION['role'] == 'admin') { ?>
                    <a href="http://localhost/wonderkidz/admin/dashboard.php" class="text-white">
                        <i class="fa-solid fa-right-to-bracket fa-lg"></i>
                    </a>
                <?php } elseif ($_SESSION['role'] == 'student') { ?>
                    <a href="http://localhost/wonderkidz/student/student-dashboard.php" class="text-white">
                        <i class="fa-solid fa-right-to-bracket fa-lg"></i>
                    </a>
                <?php }
            } else { ?>
                <a href="select.php" class="text-white">
                    <i class="fa-solid fa-right-to-bracket fa-lg"></i>
                </a>
            <?php } ?>
        </div>
    </div>
</nav>