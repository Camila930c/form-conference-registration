<?php
require 'db.php';

function getOptions($table) {
    global $conn;
    $options = [];
    $query = "SELECT * FROM $table ORDER BY ID";
    $result = $conn->query($query);

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            $options[] = $row;
        }
    }

    return $options;
}


?>
