<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }

    require_once '../Model/Model.php';

    $GSM= Model::load('gsm');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $GSM -> read('','',$JOIN,'');

    $_SESSION['erreur'] = 0;

    //echo 'je suis avant les if</br>';

    /**
     * verificaton des variables
     * mise des variables en session dans l'attente de la validation du panier
     * ajout du GSM au panier
     */
    if(isset($_POST['btnPanier1']) || isset($_POST['btnPanier2']))
    {
        if(isset($_POST['idGSM']))
        {
            // tableau pour conserver les données avant l'envois vers le panier
            if($_POST['btnPanier1'])
            {
                $_SESSION['btnPanier'] = $_POST['btnPanier1'];
            }
            else
            {
                $_SESSION['btnPanier'] = $_POST['btnPanier2'];
            }
        }
        else
        {
            unset($_POST['btnPanier2']);
            unset($_POST['btnPanier1']);
            $_SESSION['erreur'] = 8;
            header('Location: GSM.php');
        }
    }

    /**
     * Modification livre
     * envoie sur manageGSM en cas de modif
     */
    else if(isset($_POST['btnModif'])
            && isset($_POST['idGSM'])
            && isset($_POST['idModele'])
            && isset($_POST['imei'])
            && isset($_POST['modele'])
            && isset($_POST['couleur'])
            && isset($_POST['ecran'])
            && isset($_POST['processeur'])
            && isset($_POST['memoire'])
            && isset($_POST['taille'])
            && isset($_POST['poids'])
            && isset($_POST['image'])
            && isset($_POST['prix'])
            && isset($_POST['actif'])
            && isset($_POST['marque'])
            && isset($_POST['logo']))
    {
        //echo 'je suis dans le if de modification</br></br>';

        if(isset($_SESSION['btnPanier']))
        {
            unset($_POST['btnPanier']);
        }

        /**
         * permet d'envoyer les sessions vers manageGSM
         */
        $_SESSION['btnModif']=$_POST['btnModif'];
        $_SESSION['idGSM']=$_POST['idGSM'];
        $_SESSION['idModele']=$_POST['idModele'];
        $_SESSION['imei']=$_POST['imei'];
        $_SESSION['modele']=$_POST['modele'];
        $_SESSION['couleur']=$_POST['couleur'];
        $_SESSION['ecran']=$_POST['ecran'];
        $_SESSION['processeur']=$_POST['processeur'];
        $_SESSION['memoire']=$_POST['memoire'];
        $_SESSION['taille']=$_POST['taille'];
        $_SESSION['poids']=$_POST['poids'];
        $_SESSION['image']=$_POST['image'];
        $_SESSION['prix']=$_POST['prix'];
        $_SESSION['actif']=$_POST['actif'];
        $_SESSION['marque']=$_POST['marque'];
        $_SESSION['logo']=$_POST['logo'];

        $marq = $_SESSION['marque'];
        $Where = " nomMarque = '$marq'";
        $GSM->read('',$Where,$JOIN,'');
        if($GSM->data == true)
        {
            foreach($GSM->data as $key)
            {
                $_SESSION['actif'] = $key->actif;
                $_SESSION['logo'] = $key->logo;
            }
        }

        /*
        echo 'btnModif est : '.$_SESSION['btnModif'].'</br>';
        echo 'idGSM est : '.$_SESSION['idGSM'].'</br>';
        echo 'imei est : '.$_SESSION['imei'].'</br>';
        echo 'modele est : '.$_SESSION['modele'].'</br>';
        echo 'couleur est : '.$_SESSION['couleur'].'</br>';
        echo 'ecran est : '.$_SESSION['ecran'].'</br>';
        echo 'processeur est : '.$_SESSION['processeur'].'</br>';
        echo 'memoire est : '.$_SESSION['memoire'].'</br>';
        echo 'taille est : '.$_SESSION['taille'].'</br>';
        echo 'taille est : '.$_SESSION['poids'].'</br>';
        echo 'image est : '.$_SESSION['image'].'</br>';
        echo 'prix est : '.$_SESSION['prix'].'</br>';
        echo 'actif est : '.$_SESSION['actif'].'</br>';
        echo 'marque est : '.$_SESSION['marque'].'</br>';
        */

        header("location: manageGSM.php");
    }

    /**
     * Supprimer un GSM
     */
    else if(isset($_POST['btnSupp'])
        && isset($_POST['idGSM'])
        && isset($_POST['idModele']))
    {
        echo 'je suis dans le if de supprimer</br></br>';

        if(isset($_POST['btnPanier']))
        {
            unset($_POST['btnPanier']);
        }

        /**
         * permet d'envoyer les sessions vers manageGSM
         */
        $_SESSION['btnSupp']=$_POST['btnSupp'];
        $_SESSION['idGSM']=$_POST['idGSM'];
        $_SESSION['idModele']=$_POST['idModele'];


        echo 'btnSupp est : '.$_SESSION['btnSupp'].'</br>';
        echo 'idGSM est : '.$_SESSION['idGSM'].'</br>';
        echo 'idModele est : '.$_SESSION['idModele'].'</br>';


        header("location: supprimerGSM.php");
    }
