<?php

    $Titre = 'Panier';
    require_once '../View/Header.php';
    require_once '../Model/Model.php';
    require '../Controller/Form.php';

    $gsm = Model::load('GSM');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $gsm -> read('','',$JOIN,'');

    require_once('../VIEW/panier.php');

    require_once('../VIEW/footer.php');
