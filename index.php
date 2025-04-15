<?php

/*
TODO:

Completer isJoined avec isJoinable qui contiendra en plus les regles d'acces au challenge

Section Correction: "Travaux que je peux corriger" > Affichages Rendus >=2 > Selection > Affichage rendu > Etes-vous sûr ? > BDD
Section Mes travaux: if !isset(statut1) > Non corrigé, else > En cours / if !isset(statut3) if(total >=2) validé > obtenir mon badge, sinon non validé > Recommencer

Section "Obtenir mon badge" quand validé par triumvirat Ou valider le badge quand 3eme statut ajouté

*/

include('header.php');

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if($isConnected) {
	include('bcaAccessCodeSystem.php');

	$accessCode = getAccessCodeFromDB();
	$accessCodeArrayed = stringToArrayAccessCode($accessCode);

	if(isset($_POST['course'])){
		setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
	}
}



?>

<div class="cleared"></div>
<h1>Bonsai Coach Academie</h1>
<p id="baseline">Plateforme d'apprentissage de <em>l'art du bonsaï</em></p>

<h2>Mes parcours & badges</h2>
<?php
if($isConnected) {
	displayCoursesList($accessCodeArrayed);
}
?>

<h2 id="courses">Badges disponibles</h2>


<ul id="badge-list">
	<li id="badge"><i class="fa fa-graduation-cap"></i> Apprenti</li>
	<li id="badge"><i class="fa fa-handshake"></i> Compagnon</li>
	<li id="badge"><i class="fa fa-hand-holding"></i> Passeur</li>
	<li id="badge"><i class="fa fa-star"></i> Guide</li>
</ul>

<?php
include('footer.php');
?>