<?php

$data = [];

if (isset($_FILES['upload']['name'])) {
      // file name
      $filename = $_FILES['upload']['name'];

      // Location
      $location = "../assets/img/uploads/" . $filename;
      $newFileName = time() . '_' . $filename;
      $newLocation = "../assets/img/uploads/" . $newFileName;

      // file extension
      $file_extension = pathinfo($location, PATHINFO_EXTENSION);
      $file_extension = strtolower($file_extension);

      // Valid extensions
      $valid_ext = array("jpg", "png", "jpeg");

      if (in_array($file_extension, $valid_ext)) {
            // Upload file
            if (move_uploaded_file($_FILES['upload']['tmp_name'], $newLocation)) {
                  $data['fileName'] = $filename;
                  $data['uploaded'] = 1;
                  $data['url'] = "/assets/img/uploads/" . $newFileName;
            }
      } else {
            $data['uploaded'] = 0;
            $data['error']['message'] = 'File not uploaded.';
      }
} else {
      $data['uploaded'] = 0;
      $data['error']['message'] = 'File not uploaded.';
}

echo json_encode($data);
die;
