<?php

    $Titre =' Modifier le GSM';
    require_once '../View/Header.php';
    require_once '../Model/Model.php';
    require_once '../Controller/Form.php';

    $GSM = Model::load('gsm');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $GSM -> read('','',$JOIN,'');

    /*
    echo '//////////////////////////////////////////////////</br>';
    echo 'valeur des session</br>';
    echo '//////////////////////////////////////////////////</br>';
    echo 'ce que l\'on recois de manageSM</br>';
    echo 'btnModif est : '.$_SESSION['btnModif'].'</br>';
    echo 'idGSM est : '.$_SESSION['idGSM'].'</br>';
    echo 'idModele est : '.$_SESSION['idModele'].'</br>';
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
    echo 'marque est : '.$_SESSION['logo'].'</br>';
    echo '//////////////////////////////////////////////////</br>';
    */


    /**
     * recoit les information de ../View/manageGSM.php
     * ce qui va permet de tester
     * mettre a jour la db
     * récupération des données en cas de champ vide
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

    if (empty($_POST['imei']) && isset($_SESSION['imei']))
    {
        $_POST['imei'] = $_SESSION['imei'];
    }

    if (empty($_POST['modele']) && isset($_SESSION['modele']))
    {
        $_POST['modele'] = $_SESSION['modele'];
    }

    if (empty($_POST['couleur']) && isset($_SESSION['couleur']))
    {
        $_POST['couleur'] = $_SESSION['couleur'];
    }

    if (empty($_POST['ecran']) && isset($_SESSION['ecran']))
    {
        $_POST['ecran'] = $_SESSION['ecran'];
    }

    if (empty($_POST['processeur']) && isset($_SESSION['processeur']))
    {
        $_POST['processeur'] = $_SESSION['processeur'];
    }

    if (empty($_POST['memoire']) && isset($_SESSION['memoire']))
    {
        $_POST['memoire'] = $_SESSION['memoire'];
    }

    if (empty($_POST['taille']) && isset($_SESSION['taille']))
    {
        $_POST['taille'] = $_SESSION['taille'];
    }

    if (empty($_POST['poids']) && isset($_SESSION['poids']))
    {
        $_POST['poids'] = $_SESSION['poids'];
    }
    
    if (empty($_POST['image']) && isset($_SESSION['image']))
    {
        $_POST['image'] = $_SESSION['image'];
    }

    if (empty($_POST['prix']) && isset($_SESSION['prix']))
    {
        $_POST['prix'] = $_SESSION['prix'];
    }

    if (empty($_POST['actif']) && isset($_SESSION['actif']))
    {
        $_POST['actif'] = $_SESSION['actif'];
    }

    if (empty($_POST['marque']) && isset($_SESSION['marque']))
    {
        $_POST['marque'] = $_SESSION['marque'];
    }

    if (empty($_POST['logo']) && isset($_SESSION['logo']))
    {
        $_POST['logo'] = $_SESSION['logo'];
    }
    
    //si les variables existent
    if(
        isset($_POST['idGSM']) &&
        isset($_POST['idModele']) &&
        isset($_POST['imei']) &&
        isset($_POST['modele']) &&
        isset($_POST['couleur']) &&
        isset($_POST['ecran']) &&
        isset($_POST['processeur']) &&
        isset($_POST['memoire']) &&
        isset($_POST['taille']) &&
        isset($_POST['poids']) &&
        isset($_POST['image']) &&
        isset($_POST['prix']) &&
        isset($_POST['actif']) &&
        isset($_POST['marque']) &&
        isset($_POST['logo']))
    {
        if(!empty($_POST['modele']) && !empty($_POST['marque']) && ($_SESSION['prix']>= 0))
        {
            //passage de $_ en $
            $idGSM = $_POST['idGSM'];
            $idMod = $_POST['idModele'];
            $imei = htmlspecialchars($_POST['imei']);
            $modele = htmlspecialchars($_POST['modele']);
            $couleur = htmlspecialchars($_POST['couleur']);
            $ecran = $_POST['ecran'];
            $processeur = htmlspecialchars($_POST['processeur']);
            $memoire= htmlspecialchars($_POST['memoire']);
            $taille = htmlspecialchars($_POST['taille']);
            $poids = $_POST['poids'];
            $image = $_POST['image'];
            $prix = $_POST['prix'];
            $actif = $_POST['actif'];
            $marque = $_POST['marque'];
            $logo = $_POST['logo'];

            //verif de base
            if($prix < 0)
            {
                $_SESSION['erreur'] = 1;
                header("Location: ../Controller/manageGSM.php" );
            }
            else
            {
                /**
                 * récuperation de l'id pour la modification du GSM
                 */
                foreach ($GSM -> data as $key)
                {
                    if($marque == $key->nomMarque)
                    {
                        $idMarque = $key->marques_id;
                    }
                }

                // lecture en db pour verifier que le modeles correspond avec la marque
                $Where = " nomModele = '$modele' and nomMarque = '$marque' and id_gsm = '$idGSM'";
                $GSM -> read('',$Where,$JOIN,'');

                if($GSM -> data == true)
                {
                    // si bon, on peut modifier
                    if(
                        $idGSM != $_SESSION['idGSM'] ||
                        $idMod != $_SESSION['idModele'] ||
                        $imei != $_SESSION['imei'] ||
                        $modele != $_SESSION['modele'] ||
                        $couleur != $_SESSION['couleur'] ||
                        $ecran != $_SESSION['ecran'] ||
                        $processeur!= $_SESSION['processeur'] ||
                        $memoire != $_SESSION['memoire'] ||
                        $taille != $_SESSION['taille'] ||
                        $poids != $_SESSION['poids'] ||
                        $image != $_SESSION['image'] ||
                        $prix != $_SESSION['prix'] ||
                        $actif != $_SESSION['actif'] ||
                        $marque != $_SESSION['marque'] ||
                        $logo != $_SESSION['logo'])
                    {
                        /*
                        echo 'on est dans le 1er if de bon modifier</br>';
                        echo '//////////////////////////////////////////////////</br>';
                        echo 'valeur des variable $</br>';
                        echo '//////////////////////////////////////////////////</br>';
                        echo 'ce que l\'on recois dans le if  pour envois la modification a la db</br>';
                        echo 'idGSM est : '.$idGSM.'</br>';
                        echo 'imei est : '.$idMod.'</br>';
                        echo 'imei est : '.$imei.'</br>';
                        echo 'modele est : '.$modele.'</br>';
                        echo 'couleur est : '.$couleur.'</br>';
                        echo 'ecran est : '.$ecran.'</br>';
                        echo 'processeur est : '.$processeur.'</br>';
                        echo 'memoire est : '.$memoire.'</br>';
                        echo 'taille est : '.$taille.'</br>';
                        echo 'taille est : '.$poids.'</br>';
                        echo 'image est : '.$image.'</br>';
                        echo 'prix est : '.$prix.'</br>';
                        echo 'actif est : '.$actif.'</br>';
                        echo 'marque est : '.$marque.'</br>';
                        echo 'logo est : '.$logo.'</br>';
                        echo '//////////////////////////////////////////////////</br>';
                        */

                        $GSM -> modficationGSM($idGSM,$idMod,$imei,$modele,$couleur,$ecran,$processeur,$memoire,$taille,$poids,$image,$prix,$actif,$marque,$logo);
                        $Where = " imei = '$imei' and nomModele = '$modele' and couleur = '$couleur' and ecran = '$ecran' and processeur = '$processeur' and memoire = '$memoire' and taille = '$taille' and poids = '$poids' and image = '$image' and prix = '$prix' and actif = '$actif' and nomMarque = '$marque' and logo = '$logo'";
                        //$modeles -> read ('',"id = '$idMod' and nomModele = '$modele' and couleur = '$couleur' and ecran = '$ecran' and processeur = '$processeur' and memoire = '$memoire' and taille = '$taille' and poids = '$poids' and image = '$image' and prix = '$prix'");
                        //$marques -> read ('',"id = '$idMarq' and nomMarque = '$marque' and logo = '$logo'");
                        $GSM -> read('',$Where,$JOIN,'');




                        if($GSM -> data == true)
                        {
                            //edition faite
                            $_SESSION['edition'] = 1;
                            header('Location: ../Controller/GSM.php ');
                        }
                        else
                        {
                            //edition ratée
                            $_SESSION['erreur'] = 2;
                            header('Location: ../Controller/manageGSM.php');
                        }
                    }
                    else
                    {
                        //aucune demande de modification
                        $_SESSION['erreur'] = 3;
                        header('Location: ../Controller/manageGSM.php');
                    }
                }
                elseif ($GSM -> data == false)
                {
                    $_SESSION['erreur'] = 4;
                    header('Location: ../Controller/manageGSM.php');
                }
                /*elseif ($modeles -> data == false && $marques -> data == false)
                {
                    $_SESSION['erreur'] = 5;
                    header('Location: ../Controller/manageGSM.php');
                }
                elseif ($modeles -> data == true && $marques -> data == false)
                {
                    $_SESSION['erreur'] = 6;
                    header('Location: ../Controller/manageGSM.php');
                }*/
            }
        }
        else
        {
            //une variable vide
            $_SESSION['erreur'] = 7;
            header('Location: ../Controller/manageGSM.php');
        }
    }
    else
    {
        //erreur de reception
        $_SESSION['erreur'] = 8;
        header('Location: ../Controller/manageGSM.php');
    }