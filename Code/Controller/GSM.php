<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    $Titre ='GSM';
    require '../View/Header.php';
    require '../Model/Model.php';
    require '../Controller/Form.php';


    require '../View/GSM.php';
    require '../View/Footer.php';