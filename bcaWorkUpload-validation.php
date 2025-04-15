<?php

include('header.php');

/* 
TODO : 
Ajout de plusieurs fichiers
*/

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;
if ($isConnected) {
  $mail = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
} else {
  echo 'Vous n\'êtes pas connecté, veuillez vous inscrire ou vous connecter sur la page d\'accueil<br><a href="index.php">Retour</a>';
  exit();
}

function getIdUser() {
  require('env.php');
  global $mail;
  $select = $db->query('SELECT id FROM user WHERE mail="'.$mail.'"');
  $result = $select->fetch();
  $counttable = count((is_countable($result) ? $result : []));
  if ($counttable != 0) {
    return $result['id'];
  } else {
    return 'erreur req';
  }
}

$idUser = getIdUser();

if (!is_dir($idUser)) {
  mkdir($idUser, 0777);
}

$nameOfDirForWork = $_GET['course'].' '.$_GET['challenge'];
$target_dir = $idUser.'/'.$nameOfDirForWork;

if (!is_dir($target_dir)) {
  mkdir($target_dir, 0777);
}

// Boucle pour gérer le multi-upload
if (isset($_POST["submit"])) {
  foreach ($_FILES["filesToUpload"]["name"] as $key => $fileName) {
    $target_file = $target_dir . '/' . basename($fileName);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Vérifiez si le fichier existe déjà
    if (file_exists($target_file)) {
      echo "Désolé, le fichier $fileName existe déjà.<br>";
      $uploadOk = 0;
    }

    // Vérifiez la taille du fichier
    if ($_FILES["filesToUpload"]["size"][$key] > 500000) {
      echo "Désolé, le fichier $fileName est trop gros.<br>";
      $uploadOk = 0;
    }

    // Autorisez certains formats de fichiers
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif" && $imageFileType != "pdf" && $imageFileType != "ppt" && $imageFileType != "pptx") {
      echo "Désolé, seul les fichiers JPG, JPEG, PNG, GIF, PDF, PPT & PPTX sont autorisés pour $fileName.<br>";
      $uploadOk = 0;
    }

    // Vérifiez si $uploadOk est défini à 0 par une erreur
    if ($uploadOk == 0) {
      echo "Le fichier $fileName n'a pas été uploadé.<br>";
    } else {
      // Essayez d'uploader le fichier
      if (move_uploaded_file($_FILES["filesToUpload"]["tmp_name"][$key], $target_file)) {
        echo "Le fichier ". htmlspecialchars($fileName). " a été uploadé avec succès.<br>";
      } else {
        echo "Désolé, une erreur est survenue lors de l'upload du fichier $fileName.<br>";
      }
    }
  }
}

?>

<br>
<a href="index.php">Retour</a>