<?php
    for($i=1;$i<=sizeof($_FILES);$i++){
        $fileName = 'file'.$i;
        if ( 0 < $_FILES[$fileName]['error'] ) {
            echo 'Error: ' . $_FILES[$fileName]['error'] . '<br>';
        }
        else {
            move_uploaded_file($_FILES[$fileName]['tmp_name'], 'uploads/' . $_FILES[$fileName]['name']);
        }
    }
?>