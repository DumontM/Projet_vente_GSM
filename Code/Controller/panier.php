<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }

    $Titre = 'Panier';
    require_once '../View/Header.php';
    require_once '../Model/Model.php';
    require_once '../Model/Panier.php';
    require_once 'typeCompte.php';
    require_once '../Controller/Form.php';

    if(($_SESSION['typeCompte'] == 1) || ($_SESSION['typeCompte'] == 2) ||($_SESSION['typeCompte'] == 3))
    {
        $panier = new Panier();

        if(isset($_SESSION['panier']))
        {
            require_once 'commande.php';

            //pour la suppression d'un article
            if(isset($_GET['supp']))
            {
                $_SESSION['suppCommandeDetail']= $_GET['supp'];
                $panier->supp($_GET['supp'])
                header('location: Panier.php');
            }

            require_once('../VIEW/panierGrafikart.php');
        }
        else
        {
            echo '<div  class="alert alert-secondary text-center font-weight-light-bold" role="alert">Votre panier est vide ! </div>';
        }

        require_once('../VIEW/Footer.php');

    }
    else
    {
        header('location: connection.php');
    }

