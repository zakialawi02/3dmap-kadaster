<?php
// Start or resume the session
session_start();
// print_r($_SESSION);
// Retrieve the message object from the session

?>

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
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.10.3/dist/sweetalert2.min.css " rel="stylesheet">

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Parcel Data</title>
</head>

<?php include_once '../../action/get-parcel.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>
    <!-- <?php echo "<pre>" ?>
    <?php print_r($parcel_table) ?> -->
    <main>
        <div class="container">
            <div class="row justify-content-center  m-2 p-3">
                <div class="row gap-2 ">
                    <div class="col-md-6">
                        <a href="/data/parcel/add-parcel.php" class="btn btn-primary">Tambah Parcel Data</a>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Parcel id</th>
                                        <th scope="col">Parcel Name</th>
                                        <th scope="col">Parcel Occupant</th>
                                        <th scope="col">Tag</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php foreach ($parcel_table as $row) : ?>
                                        <?php $tags = json_decode($row['tag'], true); ?>
                                        <tr>
                                            <th scope="row"><?= $no++; ?></th>
                                            <td><?= $row['parcel_id']; ?></td>
                                            <td><?= $row['parcel_name'] ?></td>
                                            <td><?= $row['parcel_occupant']; ?></td>
                                            <td>
                                                <?php foreach ($tags as $tag) : ?>
                                                    <span class="badge rounded-pill bg-secondary"> <?= $tag['word_name']; ?></span>
                                                <?php endforeach ?>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-row gap-1">
                                                    <a href="/data/parcel/edit-parcel.php?parcel=<?= $row['parcel_id']; ?>" class="btn xs-btn btn-secondary bi bi-pencil-square"></a>
                                                    <form id="delete-<?= $row['parcel_id']; ?>" action="/action/delete-parcel.php" method="post">
                                                        <input type="hidden" name="parcel_id" value="<?= $row['id']; ?>">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <button type="button" class="asbn btn btn-danger bi bi-trash delete-btn" data-id="<?= $row['parcel_id']; ?>"></button>
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
    </script>


</body>

</html>