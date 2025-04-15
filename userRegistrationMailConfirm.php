<?php

require_once('env.php');
$mail = $_GET["mail"];
// verif si mail existe pas déjà
$selectall = $db->query('SELECT * FROM user WHERE mail="'.$mail.'"');
$result = $selectall->fetch();
$counttable = count((is_countable($result)?$result:[]));
// sinon, insertion en base
if($counttable==0){
    $res = $db->prepare('INSERT INTO user (mail,password) VALUES(:mail,:password)');
    $pwd = $_GET["token"];
    $res->execute(array('mail' => $mail,'password' => $pwd));
    $return = "Inscription validée, vous pouvez maintenant vous connecter !";
}
else{
    $return = '<span style="color:red">Mail déjà inscrit</span>';
}

include('header.php');

?>

<div class="container">
    <header>
        <nav>
            <ul id="connection">
                <a href="userConnectionForm.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
            </ul>
        </nav>
        <div class="cleared"></div>

        <h1><?php echo $return ?></h1>
    </header>

        <ul id="retour">
            <ol id="return">
                <a href="index.php">Retour</a>
            </ol>
        </ul>

</div>

<?php
include('footer.php');
?>