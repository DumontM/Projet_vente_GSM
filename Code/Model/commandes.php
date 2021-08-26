<?php


    class commandes extends Model
    {
        var $table = 'commandes';
        var $data;

        /**
         * Crée une nouvelle commande
         * @param $pStatut
         * @param $pPrix_total
         * @param $pUtilisateur_id
         * @param $pGSM_id
         */
        public function ajoutCommande($pStatut, $pPrix_total, $pUtilisateur_id, $pGSM_id)
        {
            $this->bdd->beginTransaction();

            try
            {
                $stmt = $this->bdd->prepare("CALL SP_NouvelleCommande(:pStatut, :pPrix_total, :pUtilisateur_id, :pGSM_id)");
                $stmt->bindParam(":pStatut", $pStatut,PDO::PARAM_STR,100);
                $stmt->bindParam(":pPrix_total",$pPrix_total,PDO::PARAM_STR,10.2);
                $stmt->bindParam(":pUtilisateur_id",$pUtilisateur_id,PDO::PARAM_INT,11);
                $stmt->bindParam(":pGSM_id",$pGSM_id,PDO::PARAM_INT,11);
                $stmt->execute();
                $stmt->commit();
            }
            catch (Exception $e)
            {
                $this->bdd->rollBack();
            }
        }

        public function ModifCommande($pId,$pStatut)
        {
            $this->bdd->beginTransaction();

            try
            {
                $stmt = $this->bdd->prepare("CALL SP_Modifier_Commande(:pId,:pStatut)");
                $stmt->bindParam("pid",$pId,PDO::PARAM_INT,11);
                $stmt->bindParam(":pStatut",$pStatut,PDO::PARAM_STR,100);
                $stmt->execute();
                $stmt->commit();
            }
            catch (Exception $e)
            {
                $this->bdd->rollBack();
            }
        }
    }