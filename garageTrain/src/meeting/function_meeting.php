<?php

require_once('../../database/db.php');

function getAllMeetings() {
    $conn = connectDB();

    $result = $conn->query("SELECT * FROM rendezvous");
    $clients = [];
    while ($row = $result->fetch_assoc()) {
        $rdvs[] = $row;
    }

    return $rdvs;
}

function getMeetingById($id) {
    $conn = connectDB();

    $query = "SELECT * FROM rendezvous WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}