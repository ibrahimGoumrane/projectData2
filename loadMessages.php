<?php
session_start();

// Connexion à la base de données
$conn = new mysqli('localhost', 'root', 'root', 'ConversationDB');
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

// Requête SQL pour récupérer les messages dans l'ordre chronologique inverse
$result = $conn->query("SELECT * FROM Conversation ORDER BY idMessage ");

// Vérification et initialisation de la sortie
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Vérification si l'auteur est le même que l'utilisateur stocké dans $_SESSION
        $isSameUser = isset($_SESSION['username']) && $_SESSION['username'] === $row['User'];
        $authorClass = $isSameUser ? "same-user" : "different-user";

        // Génération du HTML pour chaque message
        echo "<div class='chat-message $authorClass'>
                <span class='author'>{$row['User']}</span>
                <span class='text'>{$row['Message']}</span>
              </div>";
    
    }
} else {
    echo "<div class='chat-message'>Aucun message à afficher.</div>";
}

// Fermeture de la connexion
$conn->close();
?>