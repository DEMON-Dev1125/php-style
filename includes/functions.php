<?php
function Image_Upload($image) {

    $target_directory = "uploads/";
    $target_file = $target_directory . $image;
    $file_type = pathinfo($target_file, PATHINFO_EXTENSION);
    //echo "target_file = " . $target_file . "</br>";
    //echo "file_type = " . $file_type;
    //die();

    // error message is empty
    $file_upload_error_messages = "";

    // make sure that file is a real image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        // submitted file is an image
    } else {
        $file_upload_error_messages .= "<div>Submitted file is not an image.</div>";
    }

    // make sure certain file types are allowed
    $allowed_file_types = array("jpg", "jpeg", "png", "gif");
    if (!in_array($file_type, $allowed_file_types)) {
        $file_upload_error_messages .= "<div>Only JPG, JPEG, PNG, GIF files are allowed.</div>";
    }

    // make sure file does not exist
    if (file_exists($target_file)) {
        $file_upload_error_messages .= "<div>Image already exists. Try to change file name.</div>";
    }

    // make sure submitted file is not too large, can't be larger than 1 MB
    if ($_FILES['image']['size'] > (1024000)) {
        $file_upload_error_messages .= "<div>Image must be less than 1 MB in size.</div>";
    }

    // make sure the 'uploads' folder exists
    // if not, create it
    if (!is_dir($target_directory)) {
        mkdir($target_directory, 0777, true);
    }

    // if $file_upload_error_messages is still empty
    if (empty($file_upload_error_messages)) {
        // it means there are no errors, so try to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // it means photo was uploaded
            echo "<div class='alert alert-success'>Image was saved.</div>";
        } else {
            echo "<div class='alert alert-danger'>";
            echo "<div>Unable to upload photo.</div>";
            echo "<div>Update the record to upload photo.</div>";
            echo "</div>";
        }
    }
    // if $file_upload_error_messages is NOT empty
    else {
        // it means there are some errors, so show them to user
        echo "<div class='alert alert-danger'>";
        echo "<div>{$file_upload_error_messages}</div>";
        echo "<div>Update the record to upload photo.</div>";
        echo "</div>";
    }

}
?>