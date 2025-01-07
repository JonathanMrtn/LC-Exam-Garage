<?php

require_once('../../database/db.php');

function createVehicule($marque, $modele, $annee, $couleur, $kilometrage, $immatriculation, $detail, $client_id) {
    $conn = connectDB();

    $query = "INSERT INTO vehicules (marque, modele, annee, couleur, kilometrage, immatriculation, detail, client_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisissi", $marque, $modele, $annee, $couleur, $kilometrage, $immatriculation, $detail, $client_id);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

function editVehicule($marque, $modele, $annee, $couleur, $kilometrage, $immatriculation, $detail, $client_id, $id) {
    $conn = connectDB();

    $query = "UPDATE vehicules SET marque = ?, modele = ?, annee = ?, couleur = ?, kilometrage = ?, immatriculation = ?, detail = ?, client_id = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssisissii", $marque, $modele, $annee, $couleur, $kilometrage, $immatriculation, $detail, $client_id, $id);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

function deleteVehicule($id) {
    $conn = connectDB();

    $query = "DELETE FROM vehicules WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->affected_rows > 0;
}

function getVehicules() {
    $conn = connectDB();

    $result = $conn->query("SELECT * FROM vehicules");
    $vehicules = [];
    while ($row = $result->fetch_assoc()) {
        $vehicules[] = $row;
    }

    return $vehicules;
}

function getVehiculeById($id) {
    $conn = connectDB();

    $query = "SELECT * FROM vehicules WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_assoc();
}