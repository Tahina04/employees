<?php
$conn = new mysqli("localhost", "root", "", "employees");
if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}