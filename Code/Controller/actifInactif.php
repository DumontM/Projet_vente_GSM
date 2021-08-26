<?php
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