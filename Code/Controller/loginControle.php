<?php
    /**
     * vérifie que la session n'est déja pas ouverte
     */
    if(session_status() == PHP_SESSION_NONE)
    {
        session_start();
    }

    require_once '../Model/Model.php';
    include_once 'typeCompte.php';

    if((isset($_POST['pseudo'])) && (isset($_POST['password'])) && (!empty($_POST['pseudo'])) && (!empty($_POST['password'])))
    {
        echo 'je suis dans le if 1 de logincontrol</br>';
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $password = htmlspecialchars($_POST['password']);

        $utilisateurPassword = MODEL::load('utilisateurs');

        $utilisateurPassword->pseudo = $pseudo;
        $utilisateurPassword->readPassword();



        if(!empty($utilisateurPassword) && (password_verify($password, $utilisateurPassword->data['mot_passe'])))
        {
            $_SESSION['erreur']=true;
            echo '</br>je suis dans le if 2 de logincontrol</br>';
        }
        else
        {
            echo 'je suis dans le else 1 de logincontrol';
            $_SESSION['UTILISATEUR_NOM'] = $utilisateurPassword->data;
            $_SESSION['UTILISATEUR_OK'] = 1;
            $_SESSION['connecte'] = true;
        }
    }
    else
    {
        echo 'je suis dans le else 2 de logincontrol';
        $_SESSION['erreur'] = true;
    }
   header('Location: connection.php');
