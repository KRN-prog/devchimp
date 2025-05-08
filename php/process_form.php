<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = "root";
    $password = "root";
    $bdd = new PDO('mysql:host=localhost;dbname=devchimp', $username, $password);
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $email = htmlspecialchars($_POST['email']);
    $isContactInDb = $bdd->prepare("SELECT `email` FROM `contact_capture` WHERE `email` = '$email'");
    $isContactInDb->execute();
    $bdd = null;
    $rowEmail = $isContactInDb->rowCount();

    if ($rowEmail == 0) {
        $bdd = new PDO('mysql:host=localhost;dbname=devchimp', $username, $password);
        $sendMessage = $bdd->prepare("INSERT INTO `contact_capture` (`nom`,`prenom`,`email`) VALUES ('$nom','$prenom','$email')");
        $sendMessage->execute();
        $bdd = null;

        // Rediriger l'utilisateur vers une page de confirmation
        header('Location: ../merci.html');
        exit();
    }

    header('Location: ../index.html');
    exit();
} else {
    header('Location: ../index.html');
    exit();
}
?>