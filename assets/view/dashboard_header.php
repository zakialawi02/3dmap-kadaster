<style>
    @media (max-width: 1184px) {
        header nav .nav-menu {
            display: flex;
        }
    }

    @media (max-width: 994px) {
        .nav-menu-group.show {
            top: 2rem !important;
        }
    }
</style>

<header>
    <nav>
        <div class="nav-logo">
            <div class="name-logo">
                <h1>DASHBOARD</h1>
                <!-- <span>RRR Representation in 3D Land Administration Prototype</span> -->
            </div>
        </div>
        <div class="nav-menu">
            <ul class="nav-menu-group">
                <li><a href="/" title="">Home</a></li>
                <li><a href="/dashboard" title="">Dashboard</a></li>
                <li><a href="/data/uri" title="">URI Data</a></li>
                <li><a href="/data/parcel" title="">Parcel Data</a></li>
                <?php if (isset($_SESSION['islogin'])) : ?>
                    <li><a href="/action/auth/process_logout.php" title="">Logout</a></li>
                <?php else : ?>
                    <li><a href="/auth/login.php" title="">Login</a></li>
                <?php endif ?>
            </ul>
            <div id="hamb"><i class="bi bi-list"></i></div>
        </div>
    </nav>
</header>