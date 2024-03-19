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

    <title>Add renter data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>

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
                <form action="/action/save-renter.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="room_id" class="form-label">Select Room</label>
                        <select class="form-select js-example-basic-single" id="room_id" name="room_id" style="width: 100%" required>
                            <option value="" disabled selected>Select Rooms</option>
                            <!-- get with ajax asycn -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="tenant_name" class="form-label">Name of Person</label>
                        <input type="text" class="form-control" id="tenant_name" name="tenant_name" value="<?= old('tenant_name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="name_number" class="form-label">Code/Identification Resident Number (NIK)</label>
                        <input type="text" class="form-control" id="name_number" name="name_number" value="<?= old('name_number'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="tenant_job" class="form-label">Job</label>
                        <input type="text" class="form-control" id="tenant_job" name="tenant_job" value="<?= old('tenant_job'); ?>" required>
                    </div>
                    <!-- <div class="mb-3">
                        <label for="number_residents" class="form-label">Number of Residents</label>
                        <input type="text" class="form-control" id="number_residents" name="number_residents" value="<?= old('number_residents'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="marriage_status" class="form-label">Marriage Status</label>
                        <input type="text" class="form-control" id="marriage_status" name="marriage_status" value="<?= old('marriage_status'); ?>" required>
                    </div> -->
                    <div class="mb-3">
                        <label for="tenant_religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="tenant_religion" name="tenant_religion" value="<?= old('tenant_religion'); ?>" required>
                    </div>
                    <div class="row mb-3">
                        <label for="tenant_address" class="form-label">Address</label>
                        <div class="mb-3 col-md-12">
                            <label for="tenant_address" class="form-label">Address/Street Name</label>
                            <input type="text" class="form-control" id="tenant_address" name="tenant_address" value="<?= old('tenant_address'); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tenant_village" class="form-label">Village</label>
                            <input type="text" class="form-control" id="tenant_village" name="tenant_village" value="<?= old('tenant_village'); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tenant_district" class="form-label">District</label>
                            <input type="text" class="form-control" id="tenant_district" name="tenant_district" value="<?= old('tenant_district'); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tenant_city" class="form-label">City</label>
                            <input type="text" class="form-control" id="tenant_city" name="tenant_city" value="<?= old('tenant_city'); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="tenant_province" class="form-label">Province</label>
                            <input type="text" class="form-control" id="tenant_province" name="tenant_province" value="<?= old('tenant_province'); ?>" required>
                        </div>
                        <div class="mb-3 col-sm-2">
                            <label for="tenant_rt" class="form-label">RT</label>
                            <input type="text" class="form-control" id="tenant_rt" name="tenant_rt" value="<?= old('tenant_rt'); ?>" required>
                        </div>
                        <div class="mb-3 col-sm-2">
                            <label for="tenant_rw" class="form-label">RW</label>
                            <input type="text" class="form-control" id="tenant_rw" name="tenant_rw" value="<?= old('tenant_rw'); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="due_started" class="form-label">Contract started</label>
                        <input type="date" class="form-control" id="due_started" name="due_started" value="<?= old('due_started'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="due_finished" class="form-label">Contract finished</label>
                        <input type="date" class="form-control" id="due_finished" name="due_finished" value="<?= old('due_finished'); ?>">
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
            $('.js-example-basic-single').select2();
        });

        getRooms(<?= json_encode(old('room_id')) ?? NULL; ?>);

        async function getRooms(selectedRoom) {
            $.ajax({
                method: "get",
                url: "/action/get-room.php",
                dataType: "json",
                cache: true,
                success: function(response) {
                    $.each(response, function(index, roomsData) {
                        $("#room_id").append('<option value="' + roomsData.room_id + '" ' + (roomsData.room_id == selectedRoom ? "selected" : "") + '>' + "[" + roomsData.building + " - " + roomsData.parcel_id + "] " + roomsData.room_id + " - " + roomsData.room_name + '</option>');
                    });
                    (selectedRoom ? "" : $("#parcel_id").val(''));
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