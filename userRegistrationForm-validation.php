<?php

include('header.php');
// TODO : vrai token

// Afficher les erreurs à l'écran
ini_set('display_errors', 1);
// Afficher les erreurs et les avertissements
error_reporting(E_ALL);
// insertion en bdd
if(isset($_POST["valid"])){
	if(isset($_POST["bca-mail"]) && $_POST["bca-mail"]!=''){
		require_once('env.php');
        $mail = $_POST["bca-mail"];

        // verif si mail existe pas déjà
		$selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
        $result = $selectall->fetch();
        $counttable = count((is_countable($result)?$result:[]));
        if($counttable==0){
            // envoie du mail de confirmation
            $subject = 'Bonsai Coach Academy: confirmation d\'inscription';
            $pwd = password_hash($_POST['bca-pwd'],PASSWORD_BCRYPT);
            $url = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
            $message = '<html>
                            <body>
                                <p>Bonjour et bienvenue sur la BCA !</p>
                                <p>Pour terminer votre inscription, <a href="https://'.$url.'/bca/userRegistrationMailConfirm.php?mail='.$mail.'&token='.$pwd.'">veuillez cliquer ici</a>.</p>
                                <p>&Agrave; bient&ocirc;t !<br>
                                L\'association "Bonsai, la part du colibri".</p>
                            </body>
                        </html>';

            $headers[] = 'MIME-Version: 1.0';
            $headers[] = 'Content-type: text/html; charset=iso-8859-1';
            $headers[] = 'Reply-To: Pascal <contact@bonsailapartducolibri.org>';
            $headers[] = 'From: Pascal <contact@bonsailapartducolibri.org>';

            if(mail($mail, $subject, $message, implode("\r\n", $headers))){
                $return = "Nous venons de vous envoyer un mail, merci de cliquer sur le lien dans celui-ci pour confirmer l'inscription !";	
            }
        }
        else{
            $return = '<span style="color:red">Mail déjà inscrit</span>';
        }

        // require_once('env.php');
        // $mail = $_POST["bca-mail"];
        // // verif si mail existe pas déjà
        // $selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
        // $result = $selectall->fetch();
        // $counttable = count((is_countable($result)?$result:[]));
        // // sinon, insertion en base
        // if($counttable==0){
        //     $res = $db->prepare('INSERT INTO user (mail,password) VALUES(:mail,:password)');
        //     $pwd = password_hash($_POST['bca-pwd'],PASSWORD_DEFAULT);
        //     $res->execute(array('mail' => $_POST["bca-mail"],'password' => $pwd));
        //     $return = "Inscription validée, vous pouvez maintenant vous connecter !";
        // }
        // else{
        //     $return = '<span style="color:red">Mail déjà inscrit</span>';
        // }	
    }
	else{
		$return = '<span style="color:red">Veuillez préciser un mail</span>';
	}
}
else{
	$return = '<span style="color:red">Formulaire non validé</span>';
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