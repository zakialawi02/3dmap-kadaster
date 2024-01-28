<!DOCTYPE html>
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
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css " rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css" />

    <title>Add Admin</title>

</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>
<?php include_once '../../action/get-users.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container my-3 p-3 ">
            <div class="row justify-content-center">

                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>

                <div class="col-md-6">
                    <h2>Add Admin</h2>
                    <form action="/action/auth/process_register.php" method="POST">
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>

            <hr>

            <div class="m-3 p-5">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Email</th>
                            <th scope="col">Created_at</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($users_table as $row) : ?>
                            <tr>
                                <th scope="row"><?= $no++; ?></th>
                                <td><?= $row['email']; ?></td>
                                <td><?= $row['created_at']; ?></td>
                                <td>
                                    <div class="d-flex flex-row gap-1">
                                        <!-- <a href="/data/user/edit-user.php?user=<?= $row['id']; ?>" class="btn xs-btn btn-secondary bi bi-pencil-square"></a> -->
                                        <?php if ($row['id'] == 1) : ?>
                                            <button type="button" class="asbn btn btn-danger bi bi-trash delete-btn" disabled></button>
                                        <?php else : ?>
                                            <form id="delete-<?= $row['id']; ?>" action="/action/delete-user.php" method="post">
                                                <input type="hidden" name="user" value="<?= $row['id']; ?>">
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="asbn btn btn-danger bi bi-trash delete-btn" data-id="<?= $row['id']; ?>"></button>
                                            </form>
                                        <?php endif ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js "></script>

    <script src="/assets/js/script.js"></script>
</body>

</html>