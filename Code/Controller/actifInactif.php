<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     *
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }*/

    // controlle l'actif inactif

    require '../Model/Model.php';

    $GSM = Model::load('gsm');

    if(isset($_POST["actif"]) && isset($_POST["id"]))
    {
        $actif = $_POST["actif"];
        $id = $_POST["id"];
    }

    $GSM->modifActif($actif,$id);

    header("Location: ../Controller/detailGSM.php");