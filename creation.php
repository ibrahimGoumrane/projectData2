<?php
$host = 'localhost'; // Adresse de votre serveur MySQL
$username = 'root';  // Nom d'utilisateur MySQL
$password = 'root';      // Mot de passe MySQL

try {
    // Connexion au serveur MySQL
    $conn = new PDO("mysql:host=$host", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Connexion au serveur réussie. <br>";

    // Script SQL pour créer la base de données et les tables
    $sql = "
    CREATE DATABASE IF NOT EXISTS ConversationDB;
    USE ConversationDB;

    -- Table Conversation
    CREATE TABLE IF NOT EXISTS Conversation (
        idMessage INT AUTO_INCREMENT PRIMARY KEY,
        User VARCHAR(50) NOT NULL,
        Message VARCHAR(255) NOT NULL
    );
    ";

    // Exécution du script SQL
    $conn->exec($sql);
    echo "Base de données et tables créées avec succès.";

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
