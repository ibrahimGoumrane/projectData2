<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $message = $_POST['message'];

    // Connexion à la base de données
    $conn = new mysqli('localhost', 'root', 'root', 'ConversationDB');
    if ($conn->connect_error) {
        die("Erreur de connexion : " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO Conversation (User, Message) VALUES (?, ?)");
    $stmt->bind_param("ss", $username, $message);
    $stmt->execute();
    $_SESSION['username'] = $username;
    $stmt->close();
    $conn->close();
    //send the success message
    echo "Message envoyé avec succès.";
}
?>