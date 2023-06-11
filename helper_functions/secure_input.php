<?php

/**
Remove whitespace, slashes and change data to an HTML representation
*/
function secure_input ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>