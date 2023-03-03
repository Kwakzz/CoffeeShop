<?php

// --- HELPER FUNCTION ---
// remove whitespace, slashes and change data to an HTML representation
function secureInput ($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>