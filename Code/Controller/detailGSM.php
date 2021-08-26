<?php
    $Titre ='Détails GSM';
    require '../View/Header.php';
    require_once'../Model/Model.php';
    require'../Controller/Form.php';

    $gsm= Model::load('gsm');


    // recupperation id modele par le post[idimg] ou par le post[detailGSM] qui viennent de affichageGSM.php
    // recupperation id modele par le post[actifOuInactif] qui vient de detailGSM.php
    if(isset($_POST['idImg'])|| isset($_POST['detailGSM'])||isset($_POST['actifOuInactif']) || isset($_POST['idRetour']))
    {
        if(isset($_POST['idImg']))
        {
            $id=$_POST['idImg'];
        }
        elseif(isset($_POST['detailGSM']))
        {
            $id=$_POST['detailGSM'];
        }
        elseif(isset($_POST['actifOuInactif']))
        {
            $id=$_POST['actifOuInactif'];
        }
        else
        {
            $id=$_POST['idRetour'];
        }
    }

    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $gsm -> read('','',$JOIN,'');

    require '../View/detailGSM.php';
    require '../View/Footer.php';