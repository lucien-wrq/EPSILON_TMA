<?php

// TODO: Afficher un listing des fichiers dans le dossier [numDuParcours][numDuChallenge]

$work[0][2] = 'Techniques de base de l’apprentissage de l’académie';
$work[2][4] = 'Méthode orientale & méthode occidentale de l’apprentissage';

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if($isConnected) {
  include('bcaAccessCodeSystem.php');
}

$course = 'course'.$_GET['course'];
$challenge = 'rank'.$_GET['challenge'];

?>

<style>
  body {
  font-family: Arial, sans-serif;
  color: white;
  margin: 0;
  padding: 0;
  }
  h2 {
  color: #0056b3;
  }
  strong {
  color: beige;
  }
  form {
  padding: 20px;
  border-radius: 5px;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  max-width: 500px;
  margin: 20px auto;
  }
  input[type="file"] {
  margin: 10px 0;
  }
  input[type="submit"] {
  background-color: #0056b3;
  border: none;
  padding: 10px 15px;
  border-radius: 5px;
  cursor: pointer;
  }
  input[type="submit"]:hover {
  background-color: #003d80;
  }
  a {
  display: inline-block;
  margin-top: 20px;
  color: #0056b3;
  text-decoration: none;
  }
  a:hover {
  text-decoration: underline;
  }
</style>

<?php
echo '<h2>Description du travail</h2><strong>
      Parcours actuel</strong> : '.$$course.'<br>';
echo '<strong>Challenge visé</strong> : '.$$challenge.'<br>';
echo '<strong>Défi demandé</strong> : <u>'.$work[$_GET['course']][$_GET['challenge']].'</u><br><br>';
?>

<h2>Upload du travail</h2>

<form action="bcaWorkUpload-validation.php?course=<?=$_GET['course']?>&challenge=<?=$_GET['challenge']?>" method="post" enctype="multipart/form-data">
  Sélectionnez des fichiers à uploader :
  <input type="file" name="filesToUpload[]" id="fileToUpload" multiple>
  <input type="hidden" name="course" value="<?=$_GET['course'] ?>">
  <input type="hidden" name="challenge" value="<?=$_GET['challenge'] ?>">
  <input type="submit" value="Upload" name="submit">
</form>

<br>
<a href="index.php">Retour</a>

<?php
include('footer.php');
?>