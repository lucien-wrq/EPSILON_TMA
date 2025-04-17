<?php

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail']));
if ($isConnected) {
    $mail = $_COOKIE['mail'] ?? $_SESSION['mail'];
} else {
    echo 'Vous n\'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d\'accueil<br><a href="index.php">Retour</a>';
    exit();
}

function getIdUser() {
  require('env.php');
  global $mail;
  $stmt = $db->prepare('SELECT id FROM user WHERE mail = ?');
  $stmt->execute([$mail]);
  $result = $stmt->fetch();

  return $result ? $result['id'] : 'erreur req';
}


$idUser = getIdUser();

if (!is_dir($idUser)) {
    mkdir($idUser, 0777);
}

$nameOfDirForWork = preg_replace('/[^a-zA-Z0-9-_]/', '_', $_GET['course'].'_'.$_GET['challenge']);
$target_dir = $idUser . '/filesUploaded_' . $nameOfDirForWork;

if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

if (isset($_POST["submit"])) {
    $count_files = count($_FILES["fileToUpload"]["name"]);

    for ($i = 0; $i != $count_files; $i++) {
        $file_name = basename($_FILES["fileToUpload"]["name"][$i]);
        $target_file = $target_dir . '/' . $file_name;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        if (file_exists($target_file)) {
            echo "Désolé, le fichier $file_name existe déjà.<br>";
            $uploadOk = 0;
        }

        if ($_FILES["fileToUpload"]["size"][$i] > 500000) {
            echo "Désolé, le fichier $file_name est trop gros.<br>";
            $uploadOk = 0;
        }

        $allowed = ["jpg", "jpeg", "png", "gif", "pdf", "ppt", "pptx"];
        if (!in_array($imageFileType, $allowed)) {
            echo "Le fichier $file_name n'a pas un format autorisé.<br>";
            $uploadOk = 0;
        }

        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file)) {
                echo "Le fichier $file_name a été uploadé avec succès.<br>";
            } else {
                echo "Erreur lors de l'upload du fichier $file_name.<br>";
            }
        } else {
            echo "Le fichier $file_name n'a pas été uploadé.<br>";
        }
    }
}

?>

<br>
<a href="index.php">Retour</a>