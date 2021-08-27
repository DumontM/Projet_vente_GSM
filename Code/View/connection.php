<?php
    if(isset($_SESSION['erreur']))
    {
        echo '<div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Erreur</strong> de nom d\'utilisateur ou mot de passe !</div>';

        unset($_SESSION['ERROR']);
    }

    if(!isset($_SESSION['connecte']))
    {
        function chargerClasse($classe)
        {
            require_once '../View/Functions/'.$classe.'php';
        }

        /**
         * on enregistre la fonction en la chargent automatiquement pour qu'elle soit appelé dès qu'on l'initialisera une classe non déclarée
         */
        spl_autoload_register('chargerClasse');

        echo'<h1 class="h3 mb-3 font-weight-normal"> Veuillez vous connecter svp !</h1><br /><br /><div class="container" style="width:350px">';

        $formConnect = new Form('formConnect','formConnect','POST','loginControle.php','');
        $formConnect->setText('Veuillez entrer votre Pseudo : ', 'pseudo', 'pseudo','','true','Pseudo');
        echo'<div class="msgErreur" id="resultat"></div>';
        $formConnect->setPassword('Entrez votre mot de passe : ','password','password','',true, 'mot de passe');
        echo'<div class="msgErreur" id="resultat2"></div>';
        $formConnect->setSubmit('Connexion','connexion','','Connexion','btn btn-lg btn-primary btn-block');
        echo $formConnect->getMyFrom();
    }
    else
    {
        if(isset($_SESSION['message']))
        {
            echo $_SESSION['message'];
            unset($_SESSION['message']);

            $formDecon =new Form('formDeconnection', 'formDeconnection','POST','Deconnexion.php','');
            $formDecon->setSubmit('formdeconnection','formdeconnection','','Retour','btn btn-lg btn-primary');
            echo $formDecon->getMyFrom();
        }
        else
        {
            echo '<p class="msgOK">Vous êtes déjà connecté !!</p>';
            header('location: accueil.php');
        }
    }