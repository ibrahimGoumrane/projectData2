const chatWindow = document.getElementById("chatWindow");
const messageForm = document.getElementById("messageForm");
const inputUser = document.getElementById("username");
// Fonction pour charger les messages
async function loadMessages() {
  try {
    const response = await fetch("loadMessages.php");
    const data = await response.text();
    chatWindow.innerHTML = data;
  } catch (error) {
    console.error("Erreur lors du chargement des messages:", error);
  }
}
async function getLoggedInUser() {
  try {
    const response = await fetch("getUserSession.php");
    const data = await response.json();

    if (data == "None") {
      inputUser.disabled = False;
    } else {
      inputUser.value = data;
      inputUser.disabled = true;
    }
  } catch (error) {
    console.error(
      "Erreur lors du chargement de l'utilisateur connecté:",
      error
    );
  }
}

getLoggedInUser();
// Appel initial pour charger les messages
loadMessages();

// Rafraîchissement toutes les secondes
setInterval(loadMessages, 1000);

// Gestion de l'envoi du formulaire
messageForm.addEventListener("submit", async (e) => {
  e.preventDefault();
  const formData = new FormData(messageForm);
  try {
    await fetch("addMessage.php", {
      method: "POST",
      body: formData,
    });
    document.getElementById("message").value = ""; // Efface le champ message

    loadMessages(); // Recharger les messages
    chatWindow.scrollTop = chatWindow.scrollHeight; // Scroll vers le bas
    inputUser.disabled = true;
  } catch (error) {
    console.error("Erreur lors de l'envoi du message:", error);
  }
});
