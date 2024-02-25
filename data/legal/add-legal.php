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

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Add legal parcel data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>
<?php include_once '../../action/get-uri.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <!-- Modal add parcel -->
        <div class="modal fade" id="newParcel" tabindex="-1" aria-labelledby="newParcelLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newParcelLabel">New Land Parcel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="newParcelForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="NEWparcel_id" class="form-label">Parcel ID</label>
                                <input type="text" class="form-control" id="NEWparcel_id" name="NEWparcel_id" value="<?= old('NEWparcel_id'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="building" class="form-label">Building</label>
                                <input type="text" class="form-control" id="building" name="building" value="<?= old('building'); ?>">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                        <button type="submit" id="saveNewParcel" class="btn btn-primary">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container ">
            <div class="row justify-content-center  m-2 p-3">
                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <form action="/action/save-legal-object.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="mb-3">
                            <label for="object_id" class="form-label">Object ID</label>
                            <input type="text" class="form-control" id="object_id" name="object_id" value="<?= old('object_id'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="parcel_id" class="form-label">Parcel ID</label>
                        <select class="form-select" id="parcel_id" name="parcel_id" required>
                            <option value="" disabled selected>Select Land Parcel</option>
                            <option value="addParcel">Add New</option>
                            <!-- get with ajax asycn -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="parcel_name" class="form-label">Parcel Name</label>
                        <input type="text" class="form-control" id="parcel_name" name="parcel_name" value="<?= old('parcel_name'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="keywordTag" class="form-label">Tag</label>
                        <input type="text" id="multiSelectTag" name="multiSelectTag" value="[<?= old('tag'); ?>]" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>

        </div>
    </main>


    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/magicsuggest/2.1.5/magicsuggest-min.js" integrity="sha512-0qwHzv41cwsUdBjAxZb4g2U26gD3I0nbfwsM9loIDabYtspTH5XOaKpmOv/M9GQG3CCWjQvv4biWWZK7tcnDJA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/assets/js/script.js"></script>

    <script>
        $(document).ready(function() {
            const tagData = [
                <?php foreach ($uri_table as $row) : ?> {
                        id: <?= $row['id_keyword']; ?>,
                        name: '<?= $row['word_name']; ?>'
                    },
                <?php endforeach ?>
            ];
            $('#multiSelectTag').magicSuggest({
                data: tagData,
                allowFreeEntries: false, // Set true if you want to allow free text entries
                maxSelection: null, // Set to null to remove the limit
                noSuggestionText: 'No suggestions',
                placeholder: 'Type or click here',
            });
        });
    </script>

    <script>
        getLandParcel2Select(<?= json_encode(old('parcel_id')) ?? NULL; ?>);
        const newParcel = new bootstrap.Modal(document.getElementById('newParcel'), {
            keyboard: true
        });
        $("#parcel_id").change(function(e) {
            e.preventDefault()
            const getField = this.value;
            if (getField == "addParcel") {
                newParcel.show();
            }
        });
        // Event listener untuk saat modal ditampilkan
        newParcel._element.addEventListener('shown.bs.modal', function() {
            // Tambahkan parameter ke URL jika tidak ada
            if (!window.location.search.includes('newLandParcel=open')) {
                history.pushState(null, null, window.location.pathname + '?newLandParcel=open');
            }
        });
        // Event listener untuk saat modal ditutup
        newParcel._element.addEventListener('hidden.bs.modal', function() {
            // Hapus parameter dari URL jika ada
            if (window.location.search.includes('newLandParcel=open')) {
                const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.pushState({
                    path: newurl
                }, '', newurl);
            }
            getLandParcel2Select();
            $("#NEWparcel_id").val("");
            $("#building").val("");
        });

        $("#newParcelForm").submit(function(e) {
            e.preventDefault();
            $.ajax({
                method: "post",
                url: `/action/save-land-parcel.php?source=add-room`,
                data: {
                    parcel_id: $("#NEWparcel_id").val(),
                    building: $("#building").val()
                },
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        newParcel.hide();
                        getLandParcel2Select();
                    } else if (response.status == "error") {
                        console.log("error");
                        alert(response.message)
                    }
                },
                error: function(error) {
                    console.log(error);
                    alert("Failed to add land parcel data!")
                }
            });
        });

        function getLandParcel2Select(selectedParcelId) {
            $.ajax({
                method: "get",
                url: "/action/get-land-parcel.php",
                dataType: "json",
                cache: true,
                success: function(response) {
                    $('#parcel_id option:gt(1)').remove();
                    $.each(response, function(index, landParcel) {
                        $("#parcel_id").append('<option value="' + landParcel.parcel_id + '" ' + (landParcel.parcel_id == selectedParcelId ? "selected" : "") + '>' + landParcel.parcel_id + " - " + landParcel.building + '</option>');
                    });
                    (selectedParcelId ? "" : $("#parcel_id").val(''));
                },
                error: function(error) {
                    console.log("error");
                    console.log(error);
                }
            });
        }
    </script>

</body>

</html>
<?php unset($_SESSION['oldForm']); ?>