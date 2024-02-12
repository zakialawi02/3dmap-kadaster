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

    <title>Add parcel data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>
    <?php
    $address = old('address');
    $address = (!empty($address) && is_array($address)) ? $address : "";
    ?>
    <main>
        <div class="container ">
            <div class="row justify-content-center  m-2 p-3">
                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <form action="/action/save-resident.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <div class="mb-2">
                            <label class="form-label">Resident Type</label>
                        </div>
                        <div class="d-flex gap-4 px-3 mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="resident_type" value="Individual" id="Individual" checked>
                                <label class="form-check-label" for="Individual">individual</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="resident_type" value="Entity" id="Entity">
                                <label class="form-check-label" for="Entity">Group/Institution</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3" id="entitySegment">
                        <label for="resident_entity" class="form-label">Name of occupant/institution</label>
                        <input type="text" class="form-control" id="resident_entity" name="resident_entity" value="<?= old('resident_entity'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="resident_name" class="form-label">Name of Person</label>
                        <input type="text" class="form-control" id="resident_name" name="resident_name" value="<?= old('resident_name'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="resident_code" class="form-label">Code/Identification resident number (NIK)</label>
                        <input type="text" class="form-control" id="resident_code" name="resident_code" value="<?= old('resident_code'); ?>" required>
                    </div>
                    <div class="mb-3" id="jobSegment">
                        <label for="job" class="form-label">Job</label>
                        <input type="text" class="form-control" id="job" name="job" value="<?= old('job'); ?>" required>
                    </div>
                    <div class="mb-3" id="titleSegment">
                        <label for="job_title" class="form-label">Job Title/Position</label>
                        <input type="text" class="form-control" id="job_title" name="job_title" value="<?= old('job_title'); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Phone</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?= old('phone_number'); ?>">
                    </div>
                    <div class="mb-3" id="religionSegment">
                        <label for="religion" class="form-label">Religion</label>
                        <input type="text" class="form-control" id="religion" name="religion" value="<?= old('religion'); ?>" required>
                    </div>
                    <div class="row mb-3">
                        <label for="resident_address" class="form-label">Address</label>
                        <div class="mb-3 col-md-4">
                            <label for="resident_address" class="form-label">District</label>
                            <input type="text" class="form-control" id="resident_address" name="district_address" value="<?= (!empty($address['district']) ? $address['district'] : ""); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="resident_address" class="form-label">City</label>
                            <input type="text" class="form-control" id="resident_address" name="city_address" value="<?= (!empty($address['city']) ? $address['city'] : ""); ?>" required>
                        </div>
                        <div class="mb-3 col-md-4">
                            <label for="resident_address" class="form-label">Province</label>
                            <input type="text" class="form-control" id="resident_address" name="province_address" value="<?= (!empty($address['province']) ? $address['province'] : ""); ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="started" class="form-label">Contract started</label>
                        <input type="date" class="form-control" id="started" name="started" value="<?= old('started'); ?>">
                    </div>
                    <div class="mb-3">
                        <label for="finished" class="form-label">Contract finished</label>
                        <input type="date" class="form-control" id="finished" name="finished" value="<?= old('finished'); ?>">
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
            const selectedValue = $('input[name="resident_type"]:checked').val();
            // Menampilkan nilai di konsol
            if (selectedValue === "Individual") {
                individual();
            } else if (selectedValue === "Entity") {
                groupEntity();
            }
            $('input[name="resident_type"]').change(function() {
                const selectedValue = $('input[name="resident_type"]:checked').val();
                if (selectedValue === "Individual") {
                    individual();
                } else if (selectedValue === "Entity") {
                    groupEntity();
                }
            });

            function individual() {
                $("#entitySegment").addClass("d-none");
                $('#resident_entity').attr('type', 'hidden');
                $("#titleSegment").addClass("d-none");
                $('#job_title').attr('type', 'hidden');
            }

            function groupEntity() {
                $("#entitySegment").removeClass("d-none");
                $('#resident_entity').attr('type', 'text');
                $("#titleSegment").removeClass("d-none");
                $('#job_title').attr('type', 'text');

            }
        });
    </script>



</body>

</html>
<?php unset($_SESSION['oldForm']); ?>