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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>
        p {
            font-weight: 400;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        main ul li {
            list-style-type: disc;
        }
    </style>

    <title>URI Data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>

<?php include_once '../../action/get-uri.php' ?>
<?php
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);
?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/viewer_header.php' ?>

    <main>
        <div class="container">
            <div class="row justify-content-center  m-2 p-3">
                <div class="row gap-2 ">
                    <?php if ($uri_table['isUrl'] === "true") : ?>
                        <?php
                        $url = $uri_table['uri_content'];
                        header("Location: $url");
                        exit();
                        ?>
                    <?php else : ?>
                        <?= $purifier->purify($uri_table['uri_content']); ?>
                    <?php endif ?>
                </div>
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