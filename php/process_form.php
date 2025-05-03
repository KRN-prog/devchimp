<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "root";
    $password = "";
    $con = new PDO('mysql:host=localhost;dbname=chat', $username, $password);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $sendMessage = $con->prepare("INSERT INTO `message` (`nom`,`prenom`,`email`) VALUES ('$nom','$prenom','$email')");
    $sendMessage->execute();
    $con = null;

    // Rediriger l'utilisateur vers une page de confirmation
    header('Location: merci.html');
    exit();
} else {
    header('Location: index.html');
    exit();
}
?>