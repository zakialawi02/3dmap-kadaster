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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.5/magicsuggest-min.css" integrity="sha512-GSJWiGBeg4y85t66huKij+Oev1gKtVLfi/LKSZSyaSfPrNJORYM1lZkk94kpVtWAmDjYGDsxtLlHuFUtgVKBlQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Add room data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>
<?php include_once '../../action/get-management.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container ">
            <div class="row justify-content-center  m-2 p-3">
                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <form action="/action/save-management.php?id=<?= $organizer_table['id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="organizer_name" class="form-label">Organizer Name</label>
                        <input type="text" class="form-control" id="organizer_name" name="organizer_name" value="<?= old('organizer_name') ?? $organizer_table['organizer_name']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="uri_organizer" class="form-label">Organizer Link</label>
                        <input type="text" class="form-control" id="uri_organizer" placeholder="https://" name="uri_organizer" value="<?= old('uri_organizer') ?? $organizer_table['uri_organizer']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="organizer_head" class="form-label">Head of Organizer</label>
                        <input type="text" class="form-control" id="organizer_head" name="organizer_head" value="<?= old('organizer_head') ?? $organizer_table['organizer_head']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizer_address" class="form-label">Organizer Address</label>
                        <input type="text" class="form-control" id="organizer_address" name="organizer_address" value="<?= old('organizer_address') ?? $organizer_table['organizer_address']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizer_city" class="form-label">Organizer City</label>
                        <input type="text" class="form-control" id="organizer_city" name="organizer_city" value="<?= old('organizer_city') ?? $organizer_table['organizer_city']; ?>" required>
                    </div>

                    <button type="submit" id="saveParcel" class="btn btn-primary">Submit</button>

                </form>
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
<?php unset($_SESSION['oldForm']); ?>