<?php


class GSM extends Model
{
    var $table = "gsm";
    var $data ;

    /**
     * fonction de modification actif
     * @param $actif
     * @param $id
     */
    public function modifActif($pActif,$pId)
    {
        $this->bdd->beginTransaction();

        try
        {
            $STATEMENT = $this->bdd->prepare("CALL SP_Modifier_Actif(:actif,:id)");
            $STATEMENT->bindParam(":actif", $pActif, PDO::PARAM_BOOL,1);
            $STATEMENT->bindParam("id", $pId, PDO::PARAM_INT,11);

            $STATEMENT->execute();
            $this->bdd->commit();
        }
        catch (Exception $e)
        {
            $this->bdd->rollBack();
        }
    }

    public function modficationGSM($pIdGSM, $pIdMod, $pImie, $pNomMod, $pCouleur, $pEcran, $pProcesseur, $pMemoire, $pTaille, $pPoids, $pImage, $pPrix, $pActif, $pNomMarq, $pLogo)
    {
        $this->bdd->beginTransaction();
        try
        {
            $stmt = $this->bdd->prepare("CALL SP_Modifier_GSM(:idGSM, :idMod, :imei, :nomMod, :couleur, :ecran, :processeur, :memoire, :taille, :poids, :image, :prix, :actif, :nomMarq, :logo)");
            $stmt->bindParam(":idGSM", $pIdGSM, PDO::PARAM_INT,11);
            $stmt->bindParam(":idMod", $pIdMod, PDO::PARAM_INT,11);
            $stmt->bindParam(":imei",$pImie,PDO::PARAM_STR,100);
            $stmt->bindParam(":nomMod", $pNomMod, PDO::PARAM_STR,100);
            $stmt->bindParam(":couleur",$pCouleur, PDO::PARAM_STR, 100);
            $stmt->bindParam(":ecran", $pEcran, PDO::PARAM_STR, 10.2);
            $stmt->bindParam(":processeur", $pProcesseur, PDO::PARAM_STR,100);
            $stmt->bindParam(":memoire",$pMemoire, PDO::PARAM_STR,100);
            $stmt->bindParam(":taille", $pTaille,PDO::PARAM_STR,100);
            $stmt->bindParam(":poids", $pPoids,PDO::PARAM_STR,10.2);
            $stmt->bindParam(":image", $pImage,PDO::PARAM_STR,500);
            $stmt->bindParam(":prix", $pPrix,PDO::PARAM_STR,10.2);
            $stmt->bindParam(":actif",$pActif,PDO::PARAM_STR,1);
            $stmt->bindParam(":nomMarq", $pNomMarq,PDO::PARAM_STR,100);
            $stmt->bindParam(":logo", $pLogo,PDO::PARAM_STR,500);

            $stmt->execute();
            $this->bdd->commit();
        }
        catch (Exception $e)
        {
            $this->bdd->rollBack();
            echo 'erreur procedure'.$e;
        }
    }

    public function supprimerGSM($pIdGSM, $pIdMod)
    {
        $this->bdd->beginTransaction();
        try
        {
            $stmt = $this->bdd->prepare("CALL SP_Supprimer_GSM(:idGSM, :idMod)");
            $stmt->bindParam(":idGSM", $pIdGSM, PDO::PARAM_INT,11);
            $stmt->bindParam(":idMod", $pIdMod, PDO::PARAM_INT,11);
            $stmt->execute();
            $this->bdd->commit();
        }
        catch (Exception $e)
        {
            $this->bdd->rollBack();
            echo 'erreur procedure'.$e;
        }
    }
}