<?php


    class utilisateurs extends Model
    {
        var $table = 'utilisateurs';
        var $data;
        var $pseudo;

        public function readPassword()
        {
            try
            {
                $req =$this->bdd->prepare('SELECT * FROM utilisateurs WHERE pseudo = :pseudo');
                $req->execute(['pseudo'=> $this->pseudo]);
                $this->data = $req->fetch();
            }
            catch (Exception $e)
            {
                echo 'Une erreur est survenue lors de la récupération des données';
            }
        }
    }