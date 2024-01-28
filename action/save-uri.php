<?php
// Start or resume the session
session_start();
// Include the database connection file
include 'db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/action/fucntion.php';
// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_GET['uri']) && !empty($_GET['uri'])) {
        print_r($_POST);
        $slug = $_GET['uri'];
        $slug = $conn->real_escape_string($slug);
        // Perform a database query
        $query = "SELECT * FROM uri_table WHERE slug = '$slug'";
        $result = $conn->query($query);
        if ($result->num_rows > 0) {
            $uri_table = $result->fetch_assoc();
        }
        $uriId = $uri_table['id_keyword'];

        $URIname = $_POST['URIname'];
        $slug = $_POST['uri-slug'];
        $isUrl = $_POST['isUrl'];
        $URIcontent = ($isUrl == "true") ? $_POST['URIurl'] : $_POST['URIeditor'];
        // Prepare and execute the SQL query
        $sqlInsertUri = "UPDATE uri_table SET word_name = '$URIname', slug = '$slug' , isUrl = '$isUrl', uri_content = '$URIcontent' WHERE id_keyword = $uriId";
        $resultSql = mysqli_query($conn, $sqlInsertUri);
        if ($resultSql) {
            setFlashMessage('success', 'Data updated successfully');
        } else {
            setFlashMessage('error', 'Data update failed');
            echo "Error updating data: " . $conn->error;
        }
    } else {
        // Get the form data
        $URIname = $_POST['URIname'];
        $slug = $_POST['uri-slug'];
        $isUrl = $_POST['isUrl'];
        $URIcontent = ($isUrl == "true") ? $_POST['URIurl'] : $_POST['URIeditor'];
        // Prepare and execute the SQL query
        $sqlInsertUri = "INSERT INTO uri_table (word_name, slug, isUrl,uri_content) VALUES ('$URIname', '$slug','$isUrl', '$URIcontent')";
        $resultSql = mysqli_query($conn, $sqlInsertUri);
        if ($resultSql) {
            setFlashMessage('success', 'Data saved successfully');
        } else {
            setFlashMessage('error', 'Data save failed');
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();

header("Location: /data/uri");
exit();
