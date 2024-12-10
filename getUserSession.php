<?php
session_start();
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_SESSION['username'])) {
        echo json_encode($_SESSION['username']);
    } else {
        echo json_encode("None");
    }
}

?>