<?php
    class modeles extends Model
    {
        var $table = "modeles";
        var $data ;

        /**
         * fonction de modification actif
         * @param $actif
         * @param $id
         */
        /*public function modifActif($pActif,$pId)
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
        }*/

        /**
         * fonction d'affichage du GSM avec recherche sait par l'utilisateur
         * $field c'est les champs parcouru
         * @param null $field
         * @param string $nom
         * @param string $marques
         */
        /*public function RecherhceGSM($nom = '', $marque = '')
        {
            if ($nom == null)
            {
                $nom = '%';
            }
            if ($marque == null)
            {
                $marque = '%';
            }

            $sql='SELECT * FROM '.$this->table.' INNER JOIN marques ON marques.id=modeles.marques_id where nomModele like :nom and nomMarque like :marque';

            try
            {
                $select = $this->bdd->prepare($sql);
                $noms = "%".$nom."%";
                $select->bindParam('nom',$noms, PDO::PARAM_STR, 100);
                $marques = "%".$marque."%";
                $select->bindParam('marque',$marques, PDO::PARAM_STR, 100);
                $select->execute();

                $select->setFetchMode(PDO::FETCH_OBJ); // on utilise les résultats en tant qu'objet
                $this->data = new stdClass();
                $this->data = $select -> fetchall();
            }
            catch (Exception $e)
            {
                echo 'Erreur lors de la récupération de données';
            }
        }*/

    }