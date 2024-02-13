<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>

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
        main {
            display: table;
            width: 100%;
            height: 90vh;
            text-align: center;
            color: #888;
        }

        .fof {
            display: table-cell;
            vertical-align: middle;
        }

        .fof h1 {
            font-size: 50px;
            display: inline-block;
            padding-right: 12px;
            animation: type .5s alternate infinite;
        }

        @keyframes type {
            from {
                box-shadow: inset -3px 0px 0px #888;
            }

            to {
                box-shadow: inset -3px 0px 0px transparent;
            }
        }
    </style>

    <title>404 Not Found</title>
</head>

<body>
    <!-- HEADER -->
    <?php include 'assets/view/viewer_header.php' ?>

    <main>
        <div class="fof">
            <h1>Error 404</h1>
            <p class="py-1">Page Not Found</p>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="/assets/js/script.js"></script>

    <script>
    </script>

</body>

</html>