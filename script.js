const chatWindow = document.getElementById("chatWindow");
const messageForm = document.getElementById("messageForm");

// Fonction pour charger les messages
async function loadMessages() {
  try {
    const response = await fetch("loadMessages.php");
    const data = await response.text();
    chatWindow.innerHTML = data;
    chatWindow.scrollTop = chatWindow.scrollHeight; // Scroll vers le bas
  } catch (error) {
    console.error("Erreur lors du chargement des messages:", error);
  }
}

// Appel initial pour charger les messages
loadMessages();

// Rafraîchissement toutes les secondes
setInterval(loadMessages, 1000);

// Gestion de l'envoi du formulaire
messageForm.addEventListener("submit", async (e) => {
  e.preventDefault();
    console.log('test');
  const formData = new FormData(messageForm);
  try {
    await fetch("addMessage.php", {
      method: "POST",
      body: formData,
    });
    document.getElementById("message").value = ""; // Efface le champ message

    loadMessages(); // Recharger les messages
  } catch (error) {
    console.error("Erreur lors de l'envoi du message:", error);
  }
});
