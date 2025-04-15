<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>BCA: Bonsai Coach Academie</title>
	<meta name="description" content="Plateforme d'apprentissage de l'art du bonsaï">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="styles/bonsai.css">
    <script src="https://kit.fontawesome.com/b30f5d3ef8.js" crossorigin="anonymous"></script>
</head>
<body id="inside">

    <header>
        <?php

        session_start();

        if(isset($_COOKIE['mail']) || isset($_SESSION['mail'])){
            $id = isset($_COOKIE['mail']) ? $_COOKIE['mail'] : $_SESSION['mail'];
            echo'
            <nav>
                <ul id="connection">
                    <ol id="Accueil">
                        <a href="index.php"><i class="fas fa-home"></i>Acceuil</a>
                    </ol>
                    <ol id="signup">
                        <a><i class="fas fa-user"></i> '.$id.'</a>
                    </ol>
                    <ol>
                        <i class="fas fa-lock"></i><a href="userPasswordReset.php">Change password</a>
                    </ol>
                    <ol id="signout">
                        <a href="userDisconnection.php"><i class="fas fa-sign-out-alt"></i></a>
                    </ol>
                </ul>
            </nav>
            ';
        }
        else{
            echo'
            <nav>
                <ul id="connection">
                    <ol id="Accueil">
                        <a href="index.php"><i class="fas fa-home"></i>Acceuil</a>
                    </ol>
                    <ol id="signup">
                        <a href="userRegistrationForm.php"><i class="fas fa-user-plus"></i> Inscription</a>
                    </ol>
                    <ol id="signin">
                        <a href="userConnectionForm.php"><i class="fas fa-sign-in-alt"></i> Connexion</a>
                    </ol>
                </ul>
            </nav> 
            ';
        }
        ?>
    </header>
		

