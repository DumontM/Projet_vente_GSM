<?php

class Panier extends Model
{
    private $DB;

    public function __construct($DB)
    {
        // si la session n'existe pas on l'initialise
        if(!isset($_SESSION))
        {
            session_start();
        }

        // si la session panier n'existe pas on l'initialise sous forme de tableau
        if(!isset($_SESSION['panier']))
        {
            $_SESSION['panier'] =array();
            $_SESSION['prixPanier'] = array();
        }
        $this->DB = $DB;
    }

    public function ajout($product_id)
    {
        $_SESSION['panier'][$product_id] = 1;
    }

    public function supprimer($product_id)
    {
        unset($_SESSION['panier'][$product_id]);
        unset($_SESSION['prixPanier'][$product_id]);
        unset($_SESSION['quantitePanier'][$product_id]);
    }

    public function total()
    {
        $total = 0;
        $ids =array_keys($_SESSION['panier']);
        //var_dump($ids);

        if(empty($ids))
        {
            $produit =array();
        }
        else
        {
            $produit = $this->DB->query('SELECT gsm.id_gsm, modeles.prix FROM gsm JOIN modeles ON gsm.modeles_id=modeles.id WHERE id_gsm IN ('.implode(',',$ids).')');
            //var_dump($produit);
        }
        foreach($produit as $values)
        {
            $total += $values->prix;
        }
        return $total;
    }

    public function countNbrElementsPanier()
    {
        return array_sum($_SESSION['quantitePanier']);
    }


}