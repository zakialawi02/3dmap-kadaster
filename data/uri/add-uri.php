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

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>
        .ck {
            z-index: 1 !important;
        }

        .ck-editor__editable {
            min-height: 250px;
        }
    </style>

    <title>Add URI data</title>
</head>

<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/action/first-load.php'; ?>
<?php checkIsLogin(); ?>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container">
            <div class="row justify-content-center  m-2 py-3">
                <?php if (isset($flashMessage)) : ?>
                    <div class="alert alert-<?= ($flashMessage['type'] == "success" ? "success" : "danger"); ?> alert-dismissible fade show" role="alert">
                        <span><?= $flashMessage['message']; ?></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif ?>
                <div class="col-md-12">
                    <form id="URIForm" action="/action/save-uri.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="URIname" class="form-label">URI Text</label>
                            <input type="text" class="form-control" id="URIname" name="URIname" autocomplete="off" value="<?= old('word_name'); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="uri-slug" class="form-label">slug</label>
                            <input type="text" class="form-control" id="uri-slug" name="uri-slug" autocomplete="off" value="<?= old('slug'); ?>" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isUrl" value="true" id="url">
                            <label class="form-check-label" for="url">
                                Redirect/Link url
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isUrl" value="false" id="paragraf" checked>
                            <label class="form-check-label" for="paragraf">
                                Paragraf Content
                            </label>
                        </div>
                        <div class="mb-3 py-3">
                            <label for="URIcontent" class="form-label">URI Content</label>
                            <div id="URIlink">
                                <input type="text" class="form-control" id="URIurl" name="URIurl" placeholder="https://....." autocomplete="off">
                            </div>
                            <div id="URIparagraf">
                                <textarea name="URIeditor" id="URIeditor" cols="30" rows="10"></textarea>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </main>


    <footer>
        <!-- place footer here -->
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>

    <script src="/assets/js/script.js"></script>


    <script>
        ClassicEditor
            .create(document.querySelector('#URIeditor'), {
                placeholder: 'type here!',
                sticky: false,
                toolbar: {
                    items: [
                        'undo', 'redo',
                        'exportPDF', 'exportWord', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: false
                },
                ckfinder: {
                    uploadUrl: "/action/ckfileupload.php",
                }
            })
            .then(editor => {
                window.editor = editor;
                // console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>

    <script>
        if ($("#paragraf").prop("checked")) {
            $("#URIlink").addClass("d-none");
            $("#URIparagraf").removeClass("d-none");
        } else if ($("#url").prop("checked")) {
            $("#URIparagraf").addClass("d-none");
            $("#URIlink").removeClass("d-none");
        }
        $("input[name='isUrl']").change(function(e) {
            if ($("#paragraf").prop("checked")) {
                $("#URIlink").addClass("d-none");
                $("#URIparagraf").removeClass("d-none");
            } else if ($("#url").prop("checked")) {
                $("#URIparagraf").addClass("d-none");
                $("#URIlink").removeClass("d-none");
            }
        });
        $("#URIname").change(function(e) {
            const uriname = $("#URIname").val();
            $.ajax({
                type: "GET",
                url: `/action/generateSlug.php?uriname=${uriname}`,
                dataType: "json",
                success: function(response) {
                    // console.log(response);
                    $("#uri-slug").val(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        });
    </script>


</body>

</html>
<?php unset($_SESSION['oldForm']); ?>