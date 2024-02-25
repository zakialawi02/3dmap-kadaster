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

    <title>Add room data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <!-- Modal add management -->
        <div class="modal fade" id="newManagement" tabindex="-1" aria-labelledby="newManagementLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newManagementLabel">New Organizer</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="newManagementForm" action="" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="NEWorganizer_name" class="form-label">Organizer Name</label>
                                <input type="text" class="form-control" id="NEWorganizer_name" name="NEWorganizer_name" value="<?= old('NEWorganizer_name'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="NEWorganizer_head" class="form-label">Head of Organizer</label>
                                <input type="text" class="form-control" id="NEWorganizer_head" name="NEWorganizer_head" value="<?= old('NEWorganizer_head'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="NEWorganizer_address" class="form-label">Organizer Address</label>
                                <input type="text" class="form-control" id="NEWorganizer_address" name="NEWorganizer_address" value="<?= old('NEWorganizer_address'); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="NEWorganizer_city" class="form-label">Organizer City</label>
                                <input type="text" class="form-control" id="NEWorganizer_city" name="NEWorganizer_city" value="<?= old('NEWorganizer_city'); ?>" required>
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

        <!-- Modal add parcel -->
        <div class="modal fade" id="legal_object" tabindex="-1" aria-labelledby="legal_objectLabel" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="legal_objectLabel">New Land Parcel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="legal_objectForm" action="" method="POST" enctype="multipart/form-data">
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
                <form action="/action/save-room.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Room ID</label>
                        <input type="text" class="form-control" id="room_id" name="room_id" value="<?= old('room_id'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="legal_object_id" class="form-label">Legal Object</label>
                        <select class="form-select" id="legal_object_id" name="legal_object_id" required>
                            <option value="" disabled selected>Pilih Land Parcel</option>
                            <option value="addParcel">Tambah Baru</option>
                            <!-- get with ajax asycn -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="room_name" class="form-label">Room Name</label>
                        <input type="text" class="form-control" id="room_name" name="room_name" value="<?= old('room_name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="space_usage" class="form-label">Space Usage</label>
                        <input type="text" class="form-control" id="space_usage" name="space_usage" value="<?= old('room_name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="organizer" class="form-label">Management</label>
                        <select class="form-select" id="organizer" name="organizer" required>
                            <option value="" disabled selected>Select Organizer</option>
                            <option value="addParcel">Add New</option>
                            <!-- get with ajax asycn -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="rent_fee" class="form-label">Rent Fee</label>
                        <div class="input-group">
                            <div class="input-group-text">Rp.</div>
                            <input type="text" class="form-control" id="rent_fee" name="rent_fee" value="<?= old('rent_fee'); ?>" placeholder="200000" required>
                        </div>
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
        getLegalObject2Select(<?= json_encode(old('legal_object_id')) ?? NULL; ?>);
        const legal_object = new bootstrap.Modal(document.getElementById('legal_object'), {
            keyboard: true
        });
        $("#legal_object_id").change(function(e) {
            e.preventDefault()
            const getField = this.value;
            if (getField == "addParcel") {
                legal_object.show();
            }
        });
        // Event listener untuk saat modal ditampilkan
        legal_object._element.addEventListener('shown.bs.modal', function() {
            // Tambahkan parameter ke URL jika tidak ada
            if (!window.location.search.includes('parcel=open')) {
                history.pushState(null, null, window.location.pathname + '?parcel=open');
            }
        });
        // Event listener untuk saat modal ditutup
        legal_object._element.addEventListener('hidden.bs.modal', function() {
            // Hapus parameter dari URL jika ada
            if (window.location.search.includes('parcel=open')) {
                const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.pushState({
                    path: newurl
                }, '', newurl);
            }
            getLegalObject2Select();
            $("#NEWparcel_id").val("");
            $("#building").val("");
        });

        $("#legal_objectForm").submit(function(e) {
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
                        legal_object.hide();
                        getLegalObject2Select();
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

        function getLegalObject2Select(selectedLegalId) {
            $.ajax({
                method: "get",
                url: "/action/get-legal-object.php",
                dataType: "json",
                cache: true,
                success: function(response) {
                    $('#legal_object_id option:gt(1)').remove();
                    $.each(response, function(index, parcelData) {
                        $("#legal_object_id").append('<option value="' + parcelData.id + '" ' + (parcelData.id == selectedLegalId ? "selected" : "") + '>' + "[" + parcelData.id + "] " + "[" + parcelData.parcel_id + " - " + parcelData.building + "] " + " - " + parcelData.parcel_name + '</option>');
                    });
                    (selectedLegalId ? "" : $("#parcel_id").val(''));
                },
                error: function(error) {
                    console.log("error");
                    console.log(error);
                }
            });
        }
    </script>
    <script>
        getManagement2Select(<?= json_encode(old('organizer')) ?? NULL; ?>);
        const newManagement = new bootstrap.Modal(document.getElementById('newManagement'), {
            keyboard: true
        });
        $("#organizer").change(function(e) {
            e.preventDefault()
            const getField = this.value;
            if (getField == "addParcel") {
                newManagement.show();
            }
        });
        // Event listener untuk saat modal ditampilkan
        newManagement._element.addEventListener('shown.bs.modal', function() {
            // Tambahkan parameter ke URL jika tidak ada
            if (!window.location.search.includes('newManagement=open')) {
                history.pushState(null, null, window.location.pathname + '?newManagement=open');
            }
        });
        // Event listener untuk saat modal ditutup
        newManagement._element.addEventListener('hidden.bs.modal', function() {
            // Hapus parameter dari URL jika ada
            if (window.location.search.includes('newManagement=open')) {
                const newurl = window.location.protocol + "//" + window.location.host + window.location.pathname;
                window.history.pushState({
                    path: newurl
                }, '', newurl);
            }
            getManagement2Select();
            $("#NEWparcel_id").val("");
            $("#building").val("");
        });

        $("#newManagementForm").submit(function(e) {
            e.preventDefault();
            data = {
                organizer_name: $("#NEWorganizer_name").val(),
                organizer_address: $("#NEWorganizer_address").val(),
                organizer_city: $("#NEWorganizer_city").val(),
                organizer_head: $("#NEWorganizer_head").val(),
            }
            $.ajax({
                method: "post",
                url: `/action/save-management.php?source=add-room`,
                data: data,
                dataType: "json",
                success: function(response) {
                    if (response.status == "success") {
                        newManagement.hide();
                        getManagement2Select();
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

        function getManagement2Select(selectedManagement) {
            $.ajax({
                method: "get",
                url: "/action/get-management.php",
                dataType: "json",
                cache: true,
                success: function(response) {
                    $('#organizer option:gt(1)').remove();
                    $.each(response, function(index, managementData) {
                        $("#organizer").append('<option value="' + managementData.id + '" ' + (managementData.id == selectedManagement ? "selected" : "") + '>' + managementData.organizer_name + " - " + managementData.organizer_head + '</option>');
                    });
                    (selectedManagement ? "" : $("#organizer").val(''));
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