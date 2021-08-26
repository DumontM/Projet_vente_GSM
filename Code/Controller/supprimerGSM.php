<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     *
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }*/

    $Titre =' Modifier le GSM';
    require_once '../View/Header.php';
    require_once '../Model/Model.php';
    require_once '../Controller/Form.php';

    $GSM = Model::load('gsm');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $GSM -> read('','',$JOIN,'');

    echo 'btnSupp est : '.$_SESSION['btnSupp'].'</br>';
    echo 'idGSM est : '.$_SESSION['idGSM'].'</br>';
    echo 'idModele est : '.$_SESSION['idModele'].'</br>';

    /**
     * Recoit les info de checkGSM
     * ce qui va permet de tester
     * supprimer dans la db
     */
    $_SESSION['erreur'] = 0;
    if (empty($_POST['idGSM']) && isset($_SESSION['idGSM']))
    {
        $_POST['idGSM'] = $_SESSION['idGSM'];
    }

    if (empty($_POST['idModele']) && isset($_SESSION['idModele']))
    {
        $_POST['idModele'] = $_SESSION['idModele'];
    }

    if(isset($_POST['idGSM']) && isset($_POST['idModele']))
    {
        $idGSM = $_POST['idGSM'];
        $idModele = $_POST['idModele'];

        if($GSM -> data == true)
        {
            $GSM -> supprimerGSM($idGSM,$idModele);

            //suppression faite
            $_SESSION['edition'] = 2;
            header('Location: GSM.php');
        }
        else
        {
            //suppression ratée
            $_SESSION['erreur'] = 7;
            header('location: detailGSM.php');
        }
    }