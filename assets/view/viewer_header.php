<style>
    @media (max-width: 1184px) {
        header nav .nav-menu {
            display: flex;
        }
    }

    @media (max-width: 994px) {
        .nav-menu-group.show {
            top: 3rem !important;
        }
    }
</style>

<header>
    <nav>
        <div class="nav-logo">
            <div class="name-logo">
                <h1>RRR Representation <br> in 3D Land Administration Prototype</h1>
            </div>
        </div>
        <div class="nav-menu">
            <ul class="nav-menu-group">
                <li><a href="/" title="">Beranda</a></li>
                <?php if (isset($_SESSION['islogin'])) : ?>
                    <li><a href="/action/auth/process_logout.php" title="Logout">Logout</a></li>
                <?php else : ?>
                    <li><a href="/auth/login.php" title="Login">Login</a></li>
                <?php endif ?>
            </ul>
            <div id="hamb"><i class="bi bi-list"></i></div>
        </div>
    </nav>
</header>