<?php
    class Model
    {
        protected $bdd;
        protected $table;
        protected $id;
        protected $data;
        public $dump_sql;


        /**
         * connexion à la base de données
         * Model constructor.
         */

        Function __construct()
        {
            try
            {
                $dns='mysql:host=127.0.0.1;dbname=projetgsm';
                $utilisateur='Administrateur';
                $mdp='Admin';

                //option de connexion => Sera automatiquement ré-exécuté lors d'une reconnexion
                $options = array(PDO::MYSQL_ATTR_INIT_COMMAND    => "SET NAMES utf8");

                //Initialisation a la connexion de la base de donnée
                $this -> bdd = new PDO($dns,$utilisateur,$mdp,$options);
                //echo 'connexion établie<br>';
            }
            // message d'erreur lors d'echec connexion
            catch (PDOException $e)
            {
                echo 'echec de connexion '.$e->getMessage();
            }
        }

        /**
         *  function read qui permer de lire la db
         * @param null $fields
         * @param string $where
         * @param string $join
         * @param string $orderBy
         */

        public function read($fields=null, $where='', $join='', $orderBy='')
        {

            if($fields==null)
            {
                $fields = '*';
            }
            if ($this->id == null)
            {
                $sql= 'SELECT '.$fields.' from '.$this->table ;
                if($join!=''){
                    $sql.=' JOIN '.$join;
                }
                if ($where!= ''){
                    $sql.=' WHERE '.$where;
                }
                if($orderBy!=''){
                    $sql.=' order by '.$orderBy;
                }

            }
            else
            {
                $sql= 'SELECT '.$fields.' from '.$this->table .'  where '.$this->PK." = '" .$this->id."'" ;
            }


            try
            {
                // On envois la requète
                if($this->dump_sql==true)
                {
                    echo $sql;
                }

                $select = $this->bdd->query($sql);

                // On indique que nous utiliserons les résultats en tant qu'objet
                $select->setFetchMode(PDO::FETCH_OBJ);
                $this->data = new stdClass();
                $this->data = $select->fetchall();

            }
            catch ( Exception $e )
            {
                echo 'Une erreur est survenue lors de la récupération des objets';
            }
        }

        /**
         * Permet d'executer n'importe quel requete
         * @param $sql
         * @param array $data
         * @return array
         */
        public function query($sql, $data =array())
        {
            $req = $this->bdd->prepare($sql);
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }

        /**
         * function laod permet de charger une table de la db
         * @param $name
         * @return mixed
         */
        static function load($name){
            require ('../model/'.$name.'.php');
            return new $name();
        }
    }