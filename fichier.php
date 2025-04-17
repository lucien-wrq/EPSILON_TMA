<?php

include("header.php");

$isConnected = (isset($_COOKIE['mail']) || isset($_SESSION['mail'])) ? true : false;

if ($isConnected) {
    include('bcaAccessCodeSystem.php');

    $accessCode = getAccessCodeFromDB();
    $accessCodeArrayed = stringToArrayAccessCode($accessCode);

    if (isset($_POST['course'])) {
        setToOneNewJoinedCourse($_POST['course'], $accessCodeArrayed);
    }

    displayFilesUpload($accessCodeArrayed); 
}

include("footer.php");