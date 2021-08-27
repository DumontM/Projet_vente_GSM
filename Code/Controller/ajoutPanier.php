<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }

    $Titre ='Panier';

    require_once '../View/header.php';
    require_once 'typeCompte.php';
    require_once '../Model/Model.php';
    require_once '../Model/Panier.php';
    require_once 'Form.php';
    $DB = new Model();

    $panier = new Panier($DB);

    $GSM = Model::load('gsm');
    $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
    $GSM -> read('','',$JOIN,'');

    if(isset($_GET['idGSM']))
    {
        $produits = $GSM->query('SELECT * FROM gsm JOIN modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque WHERE id_gsm = :idGSM', array('idGSM'=>$_GET['idGSM']));

        if(empty($produits))
        {
            $_SESSION['erreur'] =true;
            exit();
        }

        if(!(isset($_SESSION['quantitePanier'][$produits[0]->id_gsm])))
        {
            $_SESSION['quantitePanier'][$produits[0]->id_gsm] = 0;
        }

        if($produits[0]->actif == 1)
        {
            $panier->ajout($produits[0]->id_gsm);
            if($produits[0]->id_gsm == $_GET['idGSM'])
            {
                /*foreach ($produits[0] as $produit)
                {
                    var_dump($produit);
                    die();
                    $_SESSION['prix_panier'][$produits[0]->id_gsm] = $produits[0]->prix;
                }*/
                $_SESSION['prix_panier'][$produits[0]->id_gsm] = $produits[0]->prix;
            }
            $_SESSION['insert_commande_detail'] = true;
            $_SESSION['ajout_GSM_panie_success'] = true;
        }
        else
        {
            $_SESSION['etatGSM'] = false;
        }
    }
    else
    {
        $_SESSION['erreur'] = true;
    }

    $ids =array_keys($_SESSION['panier']);
    //var_dump($ids);

    if(empty($ids))
    {
        $produit =array();
    }
    else
    {
        $produit = $GSM ->query('SELECT * FROM gsm JOIN modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque WHERE id_gsm IN ('.implode(',',$ids).')');
        //var_dump($produit);
    }

    if(isset($_SESSION['panier']))
    {
        //require_once 'commande';

        if(isset($_Get['supp']))
        {
            $_SESSION['suppCommandeDetail'] = $_Get['supp'];
            $panier->supprimer($_GET['supp']);
        }
        else
        {
            echo '<div  class="alert alert-secondary text-center font-weight-light-bold" role="alert">Votre panier est vide ! </div>';
        }
    }

    require_once '../View/panier.php';
    require_once '../View/Footer.php';