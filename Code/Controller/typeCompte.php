<?php
    /**
    * vérifie que la session n'est déja pas ouverte
    */
    if(session_status() == PHP_SESSION_NONE)
    {
    session_start();
    }
    require_once '../Model/Model.php';

    function typeCompte()
    {
        if((isset($_SESSION['UTILISATEUR_NOM']['pseudo'])) || (!empty($_SESSION['UTILISATEUR_NOM']['pseudo'])))
        {
            $utilisateurTypeCompte = Model::load('utilisateurs');
            $utilisateurTypeCompte->pseudo = $_SESSION['UTILISATEUR_NOM']['pseudo'];

            $utilisateurTypeCompte->readPassword();
            $_SESSION['typeCompte'] = null;
            $actif =null;

            if ($utilisateurTypeCompte->data['actif'] == 1)
            {
                echo 'je suis dans 2 if';
                //client
                if($utilisateurTypeCompte->data['roles_id'] == 1)
                {
                    $_SESSION['typeCompte'] = 1;
                }

                //employé
                elseif($utilisateurTypeCompte->data['roles_id'] == 2)
                {
                    $_SESSION['typeCompte'] = 2;
                }

                //admin
                elseif($utilisateurTypeCompte->data['roles_id'] == 3)
                {
                    $_SESSION['typeCompte'] = 3;
                }

                //erreur
                else
                {
                    $_SESSION['typeCompte'] = 4;
                }
            }
            else
            {
                $_SESSION['typeCompte'] = 4;
                $_SESSION['message'] = "<p class='msgErreur'>Votre compte est inactif</p>";
            }
        }
        else
        {
            $_SESSION['typeCompte'] = 4;
            if(isset($_SESSION))
            {
                $_SESSION['actif'] = false;
            }
        }
    }