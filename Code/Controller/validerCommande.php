<?php
    /**
 * vérifie que la session n'est déja pas ouverte
 *
if(session_status() == PHP_SESSION_NONE)
{
session_start();
}*/

    if(!empty($_SESSION['panier']))
    {
        require_once '../Model/Model.php';
        require_once '../View/Header.php';
        require_once 'typeCompte.php';

        $commandes = Model::load('commandes');
        $GSM = Model::load('gsm');
        $JOIN ='modeles ON gsm.modeles_id=modeles.id JOIN marques ON modeles.marques_id=marques.id_marque';
        $gsm -> read('','',$JOIN,'');

        $idUtilisateur = $_SESSION['UTILISATEUR_NOM']['id'];

        /**
         * on vérifie la session panier avant de commancer
         * mise à jour de la disponibilite du GSM
         */
        foreach ($_SESSION['panier'] as $key => $produit)
        {
            $listeGSM = $GSM->query('SELECT actif FROM gsm JOIN modeles ON gsm.modeles_id=modeles.id WHERE id_gsm = :idGSM', array('idGSM'=>$key));
            foreach($listeGSM as $values)
            {
                $stock = $values->actif - $_SESSION['quantitePanier'][$key];
                try
                {
                    $sql
                }
            }
        }
    }