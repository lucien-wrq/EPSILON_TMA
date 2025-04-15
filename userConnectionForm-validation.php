<?php

include('header.php');

if(isset($_POST["valid"])){
	if(isset($_POST["bca-mail"]) && $_POST["bca-mail"]!=''){
		require_once('env.php');
        $mail = $_POST["bca-mail"];
		$selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
        $result = $selectall->fetch();
        $counttable = count((is_countable($result)?$result:[]));
        if($counttable >= 1){
            if(password_verify($_POST["bca-pwd"],$result['password'])){
                $return = "Connexion réussie";
                // envoyer cookies ou session
                if(isset($_POST['bca-stayIn'])){
                    $expire = 365*24*3600; // on définit la durée du cookie, 1 an
                    setcookie("mail",$mail,time()+$expire);  // on l'envoi
                }
                else{
                    $_SESSION['mail'] = $mail;
                }
            }
            else{
                $return = '<span style="color:red">Mauvais mot de passe, <a href="userPasswordReset.php">réinitialisation du mot de passe</a>.</span>';
            }
        }
        else{
            $return = '<span style="color:red">Pas de mail correspondant</span>';
        }
    }
	else{
		$return = '<span style="color:red">Veuillez préciser un mail</span>';
	}
}
else{
	$return = '<span style="color:red">Formulaire non validé</span>';
}

?>


<?php
if ( $return != 'Connexion réussie' ) {
    echo'
        <form action="userRegistrationForm-validation.php" method="post">
            <table>
                <tr>
                    <td class="label" >Mail</td>
                    <td><input type="email" name="bca-mail" id="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"><br></td>
                </tr>
                <tr>
                    <td class="label">Mot de passe</td>
                    <td><input type="password" name="bca-pwd" id="" pattern=".{8,}"></td>
                </tr>
                <tr>
                    <td class="label">Rester connecté</td>
                    <td><input type="checkbox" name="bca-stayIn" id=""></td>
                </tr>
                <tr>
                    <td class="label"></td>
                    <td><input type="submit" name="valid"></td>
                </tr>
            </table>
        </form>
    ';
}


?>

    <ul id="retour">
        <ol id="return">
            <a href="index.php">Retour</a>
        </ol>
    </ul>


<?php
include('footer.php');
?>