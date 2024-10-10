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
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Organizer Data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>
<?php include_once '../../action/get-management.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container">
            <div class="row justify-content-center  m-2 p-3">
                <div class="row gap-2 ">
                    <?php if (isset($flashMessage)) : ?>
                        <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                            <span><?= $flashMessage['message']; ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif ?>
                    <div class="col-md-6">
                        <a href="/data/organizer/add-management.php" class="btn btn-primary">Add Organizer</a>
                    </div>
                    <div class="row p-3 m-2">
                        <div class="col-md-12">
                            <table id="datatable" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Organizer Name</th>
                                        <th scope="col">Link</th>
                                        <th scope="col">Organizer Head</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">City</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($organizer_table as $row) : ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['organizer_name']; ?></td>
                                            <td><a href="<?= $row['uri_organizer']; ?>"><?= $row['uri_organizer']; ?></a></td>
                                            <td><?= $row['organizer_head'] ?></td>
                                            <td><?= $row['organizer_address'] ?></td>
                                            <td><?= $row['organizer_city'] ?></td>
                                            <td>
                                                <div class="d-flex flex-row gap-1">
                                                    <a href="/data/organizer/edit-management.php?id=<?= $row['id']; ?>" class="btn xs-btn btn-secondary bi bi-pencil-square"></a>
                                                    <form id="delete-<?= $row['id']; ?>" action="/action/delete-management.php" method="post">
                                                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="asbn btn btn-danger bi bi-trash delete-btn" data-id="<?= $row['id']; ?>"></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.all.min.js "></script>
    <script src=" https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js "></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script src="/assets/js/script.js"></script>

    <script>
        $('.delete-btn').on('click', function() {
            const userId = $(this).data('id');
            Swal.fire({
                title: 'Apakah Anda yakin ingin menghapus data ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus data!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#delete-' + userId).submit();
                }
            });
        });

        const datatable = new DataTable('#datatable');
    </script>
    <?php unset($_SESSION['oldForm']); ?>


</body>

</html>