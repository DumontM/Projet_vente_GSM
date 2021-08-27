<?php
// page avec les erreurs
    if(($_SESSION['typeCompte'] == 1) || ($_SESSION['typeCompte'] == 2) || ($_SESSION['typeCompte'] == 3))
    {

        $erreur = 0;

        //verification d'erreur et récupération du code
        if (isset($_SESSION["erreur"]))
        {
            $erreur = $_SESSION["erreur"];
            unset($_SESSION["erreur"]);
        }

        //affiche message d'erreur suit au numéro récuperé
        switch ($erreur)
        {
            // modification
            case 1: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>Votre prix doit être supérieur à 0.</div>'; break;
            case 2: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>La modification du gsm a échoué.</div>'; break;
            case 3: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Il y a eu aucune modification.</div>'; break;
            case 4: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Le GSM n\'est pas modifiable.</div>'; break;
            case 5: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Vos informations doivent être complètées.</div>'; break;
            case 6: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Il a eu un problème lors de la reception des données.</div>'; break;
            // suppression
            case 7: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>La suppression du GSM a échouée.</div>'; break;
            //Panier
            case 8: echo'<div class="alert alert-danger alert-dismissible fade show" role="alert"><button type="button" class="close" data-dismiss="alert">&times;</button>Panier</div>'; break;
        }
    ?>

        <div class="container text-center">
            <div class="row-center">
                <header id="header" class="header">
                    <h1><?php /*echo $Titre */?></h1>
                </header>
            </div>

            <div class="row-center">
                <section class="section text-center">
                    <article class="article text-center">
                        <?php

                        //modification modeles
                        if (isset($_SESSION['btnModif']))
                        {
                            if(
                                isset($_SESSION["idGSM"]) &&
                                isset($_SESSION["imei"]) &&
                                isset($_SESSION["modele"]) &&
                                isset($_SESSION["couleur"]) &&
                                isset($_SESSION["ecran"]) &&
                                isset($_SESSION["processeur"]) &&
                                isset($_SESSION["memoire"]) &&
                                isset($_SESSION["taille"]) &&
                                isset($_SESSION["poids"]) &&
                                isset($_SESSION["image"]) &&
                                isset($_SESSION["prix"]) &&
                                isset($_SESSION["actif"]) &&
                                isset($_SESSION["marque"]))
                            {
                                echo'</br>';
                                $formEdit=new Form('formEdition','formEdition','POST','editionGSM.php','');
                                $formEdit->hidden('','IdGSMEdit','IdGSMEdit',isset($_SESSION['idGSM']) ? $_SESSION['idGSM'] : '');
                                $formEdit->hidden('','idModele','idModele',isset($_SESSION['idModele']) ? $_SESSION['idModele'] : '');
                                $formEdit->setText('IMEI : ','imei','imei','','',isset($_SESSION['imei']) ? $_SESSION['imei'] : '');
                                $formEdit->setText('Modèle du GSM : ','modeleEdit','modeleEdit','','',isset($_SESSION['modele']) ? $_SESSION['modele'] : '');
                                $formEdit->setText('Couleur :','couleur','couleur','','',isset($_SESSION['couleur']) ? $_SESSION['couleur'] : '');
                                $formEdit->setNumber('Ecran : ','ecran','ecran','','',isset($_SESSION['ecran']) ? $_SESSION['ecran'] : '');
                                $formEdit->setText('Processeur : ','processeur','processeur','','',isset($_SESSION['processeur']) ? $_SESSION['processeur'] : '');
                                $formEdit->setText('Mémoire : ','memoire','memoire','','',isset($_SESSION['memoire']) ? $_SESSION['memoire'] : '');
                                $formEdit->setText('Taille : ','taille','taille','','',isset($_SESSION['taille']) ? $_SESSION['taille'] : '');
                                $formEdit->setNumber('Poids : ','poids','poids','','',isset($_SESSION['poids']) ? $_SESSION['poids'] : '');
                                $formEdit->setFile('Image du GSM : ','image','image','','',isset($_SESSION['image']) ? $_SESSION['image'] : '');
                                $formEdit->setNumber('Prix : ','prix','prix','','',isset($_SESSION['prix']) ? $_SESSION['prix'] : '');
                                $formEdit->hidden('','marque','marque',isset($_SESSION['marque']) ? $_SESSION['marque'] : '');
                                //$formEdit->setText('Marques du GSM : ','marque','marque','','',isset($_SESSION['marque']) ? $_SESSION['marque'] : '');
                                $formEdit->hidden('','actif','actif',isset($_SESSION['actif']) ? $_SESSION['actif'] : '');
                                $formEdit->setSubmit('modification','modification', '','Modifier','btn btn-success');
                                echo  $formEdit->getMyFrom();


                                $formEditionRetour = new Form("formEditionRetour","formEditionRetour","POST","../Controller/detailGSM.php","");
                                $formEditionRetour->hidden("","idRetour","idRetour",$_SESSION['idGSM']);
                                $formEditionRetour->setSubmit("retourEdition","retourEdition","","Retour","");
                                echo $formEditionRetour->getMyFrom();
                            }
                        }
                        ?>
                    </article>
                </section>
            </div>
        </div>
<?php
    }
    else
    {
        header('location: connection.php');
    }
?>