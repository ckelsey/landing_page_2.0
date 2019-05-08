<?php  
    $target_dir = 'public_docs/vinpics/'; // upload directory
    $data = $_FILES["file"]["name"];
    $target_file = $target_dir.'file'.'.svg';

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["file"]["name"]). " has been uploaded.";
    } 

?>