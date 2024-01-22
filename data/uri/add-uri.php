<?php
// Start or resume the session
session_start();
// print_r($_SESSION);
// Retrieve the message object from the session
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    // Display message based on status
    if ($message['status'] == "success") {
        echo '<div class="alert alert-success">' . $message['text'] . '</div>';
    } elseif ($message['status'] == "error") {
        echo '<div class="alert alert-danger">' . $message['text'] . '</div>';
    }
}
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

    <link rel="stylesheet" href="/assets/css/style.css" />

    <style>

    </style>

    <title>Add parcel data</title>
</head>

<body>
    <!-- HEADER -->
    <?php include '../../assets/view/dashboard_header.php' ?>

    <main>
        <div class="container">
            <div class="row justify-content-center  m-2 py-3">
                <div class="col-md-6">
                    <form id="URIForm" action="/action/save-uri.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="URIname" class="form-label">URI Text</label>
                            <input type="text" class="form-control" id="URIname" name="URIname" required>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isUrl" id="url">
                            <label class="form-check-label" for="url">
                                Redirect/Link url
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="isUrl" id="paragraf" checked>
                            <label class="form-check-label" for="paragraf">
                                Paragraf Content
                            </label>
                        </div>
                        <div class="mb-3 py-3">
                            <label for="" class="form-label">URI Content</label>
                            <div id="URIlink">
                                <input type="text" class="form-control" id="URIcontent" name="URIcontent" placeholder="https://.....">
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
                toolbar: {
                    items: [
                        'exportPDF', 'exportWord', '|',
                        'findAndReplace', 'selectAll', '|',
                        'heading', '|',
                        'bold', 'italic', 'strikethrough', 'underline', 'code', 'subscript', 'superscript', 'removeFormat', '|',
                        'bulletedList', 'numberedList', 'todoList', '|',
                        'outdent', 'indent', '|',
                        'undo', 'redo',
                        '-',
                        'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                        'alignment', '|',
                        'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                        'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                        'textPartLanguage', '|',
                        'sourceEditing'
                    ],
                    shouldNotGroupWhenFull: true
                },
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
        $("#URIForm").submit(function(e) {
            // Mencegah tindakan formulir bawaan untuk mengirimkan permintaan
            e.preventDefault();
            console.log("TEXT");
            console.log($('#URIeditor').val());

            // Mendapatkan nilai radio button yang dipilih
            const isUrl = $("input[id='paragraf']").prop("checked");

            // Mendapatkan nilai dari input URIname
            const URIname = $("#URIname").val();

            // Mendapatkan nilai sesuai dengan pilihan radio button
            const URIcontent = (isUrl == true) ? $("#URIeditor").val() : $("#URIcontent").val();

            // Membuat objek data formulir
            const formData = {
                URIname: URIname,
                isUrl: isUrl,
                URIcontent: URIcontent
            };

            // Menggunakan AJAX untuk mengirim data ke server
            $.ajax({
                type: "POST",
                url: "/action/save-uri.php",
                data: formData,
                success: function(response) {
                    console.log(response);
                    // Jika data berhasil disimpan, alihkan ke halaman lain
                    window.location.href = "/data/uri.php";
                },
                error: function(error) {
                    // Menangani kesalahan AJAX (jika ada)
                    console.error("Error:", error);
                }
            });
        });
    </script>


</body>

</html>