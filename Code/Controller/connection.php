<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }

    $Titre = 'connection';

    require_once '../View/headerConnection.php';
    require_once 'Form.php';
    require_once 'typeCompte.php';

    typecompte();

    require_once '../View/connection.php';
    require_once '../View/Footer.php';