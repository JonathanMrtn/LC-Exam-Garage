<?php

require_once('../../database/db.php');

function getAllClients() {
    $conn = connectDB();

    $result = $conn->query("SELECT * FROM clients");
    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }

    return $clients;
}

function getClientById($id) {
    $conn = connectDB();

    $query = "SELECT * FROM clients WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}