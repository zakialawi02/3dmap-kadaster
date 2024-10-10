<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/assets/img/favicon.png" type="image/x-icon">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Dashboard</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>

<body>
    <!-- HEADER -->
    <?php include '../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container-fluid d-flex flex-column justify-content-center align-items-center my-3 py-3">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Welcome</h1>
            </div>
            <h3 class="fw-bold">Menu:</h3>
            <div class="row justify-content-center">
                <a href="/data/legal/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-building-fill-gear"></i>
                    Legal Data
                </a>
                <a href="/data/uri/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-link-45deg"></i>
                    URI Data
                </a>
                <a href="/data/organizer/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-person-vcard-fill"></i>
                    Manage Organizer
                </a>
                <a href="/data/room/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-building-gear"></i>
                    Rooms Data
                </a>
                <a href="/data/renters/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-person-vcard"></i>
                    Renters Data
                </a>
                <a href="/data/user/" class="col-6  btn btn-primary text-center text-lg-start text-decoration-none p-3 rounded-xl text-light fw-bold fs-5 border border-2 border-dark m-2">
                    <i class="bi bi-people-fill"></i>
                    Admin Data
                </a>
            </div>
        </div>

    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="/assets/js/script.js"></script>



</body>

</html>