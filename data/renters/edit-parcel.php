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
<?php include_once '../../action/get-parcel.php' ?>
<?php include_once '../../action/get-uri.php' ?>
<?php include_once '../../action/get-residents.php' ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>
    <?php $tags = json_decode($parcel_table['tag'], true) ?>
    <?php $tag = implode(", ", array_map(fn ($value) => $value['id_keyword'], $tags)); ?>
    <main>
        <div class="container ">
            <div class="row justify-content-center  m-2 py-3">
                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <form action="/action/save-parcel.php?parcel=<?= $parcel_table['parcel_id']; ?>" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="ObjectID" class="form-label">Object ID</label>
                        <input type="text" class="form-control" id="ObjectID" name="ObjectID" autocomplete="off" value="<?= $parcel_table['id']; ?>" disabled required>
                    </div>
                    <div class="mb-3">
                        <label for="parcelIdNew" class="form-label">Parcel ID</label>
                        <input type="hidden" class="form-control" id="parcelId" name="parcelId" autocomplete="off" value="<?= $parcel_table['parcel_id']; ?>" required>
                        <input type="text" class="form-control" id="parcelIdNew" name="parcelIdNew" autocomplete="off" value="<?= old('parcel_id') ?? $parcel_table['parcel_id']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="parcelName" class="form-label">Parcel Name</label>
                        <input type="text" class="form-control" id="parcelName" name="parcelName" autocomplete="off" value="<?= old('parcel_name') ?? $parcel_table['parcel_name']; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="parcelOccupant" class="form-label">Parcel Occupant</label>
                        <select class="form-select form-select" id="parcelOccupant" name="parcelOccupant" placeholder="select">
                            <option value=""></option>
                            <?php foreach ($residents_table as $val) : ?>
                                <option value="<?= $val['id_resident']; ?>" <?= ($val['id_resident'] == $parcel_table['parcel_occupant'] ? "selected" : ""); ?>><?= $val['resident_name']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="keywordTag" class="form-label">Tag</label>
                        <input type="text" id="multiSelectTag" name="multiSelectTag" value="[<?= old('tag') ?? $tag; ?>]" />
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
                valueField: 'id',
                displayField: 'name',
                allowFreeEntries: false, // Set true if you want to allow free text entries
                maxSelection: null, // Set to null to remove the limit
                noSuggestionText: 'No suggestions',
                placeholder: 'Type or click here',
            });
        });
    </script>


</body>

</html>
<?php unset($_SESSION['oldForm']); ?>