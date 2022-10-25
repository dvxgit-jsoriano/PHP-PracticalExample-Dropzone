<?php

// Initialize the upload folder.
$folder_name = 'dropzone_upload/';

// This is where file will be processed.
if (!empty($_FILES)) {
    $temp_file = $_FILES['file']['tmp_name'];
    $location = $folder_name . $_FILES['file']['name'];
    move_uploaded_file($temp_file, $location);
}

// Return response.
echo "File Upload Successful!";