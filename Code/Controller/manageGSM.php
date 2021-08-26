<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     *
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }*/

    require_once '../View/Header.php';
    require_once '../Model/Model.php';
    require_once 'Form.php';

    $GSM = Model::load('GSM');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $GSM -> read('','',$JOIN,'');

    require_once '../View/manageGSM.php';
    require_once '../View/footer.php';
