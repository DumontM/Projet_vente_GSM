<?php
    //controle la page afficher gsm
    session_start();
    require '../Model/Model.php';
    require '../Controller/Form.php';

    $WHERE='';
    $gsm = Model::load('GSM');

    // a veririfer car normalement c'est le formualire de recherche qui est rechModeles
    if((isset($_POST['rechercheGSM'])) && (!empty($_POST['rechercheGSM'])))
    {
        $_SESSION['rechercheGSM'] = $_POST['rechercheGSM'];
        $rechGSM = $_POST['rechercheGSM'];
        $WHERE = "nomModele LIKE '%$rechGSM%' OR nomMarque LIKE '%$rechGSM%'";
        //$modeles->RecherhceGSM($_POST['rechercheGSM']);
    }
    else if((empty($_POST['rechercheVide']) == ''))
    {
        $WHERE = '%';
        //$modeles->RecherhceGSM();
    }

    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $gsm -> read('',$WHERE,$JOIN,'');

    require '../View/affichageGSM.php';
