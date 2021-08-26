<?php
    session_start();
    // Permet de donner le role de l'utilisateur ( 1=client, 2=employé, 3=admin)
    $idRole = 3;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">          <!--lien vers le boostrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">      <!--lien vers les icones boostrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>                        <!--lien vers la bibliothèque jquerry -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../View/JS/listener.js"></script>
    <link rel="stylesheet" type="text/css" href="../View/CSS/page.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-info bg-secondary navbar-dark navbar-fixed-top justify-content-center"" id="haut">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="container ">
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="nav navbar-nav m-auto">
                    <li class="nav-item active"><a class="nav-link" href="../Controller/accueil.php"><i class="bi bi-house"></i> Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Controller/Client.php"><i class="bi bi-person"></i> Client</a></li>
                    <li class="nav-item"><a class="nav-link" href="../Controller/GSM.php"><i class="bi bi-phone"></i> GSM</a></li>
                    <li class="nav-item"><a class="nav-link" href="panier.php"><i class="bi bi-cart"></i> Panier</div></a></li>
                </ul>
            </div>
        </div>

        <div class="session">
            <?php
            if (isset($_SESSION['UTILISATEUR_OK']) && isset($_SESSION['UTILISATEUR_NOM']) && $_SESSION['UTILISATEUR_OK'] = 1)
            {
                echo '<p class="bienvenu">Bienvenu à '.$_SESSION['UTILISATEUR_NOM'].'</p>';
                echo '<form method="post" action="../Controller/Deconnexion.php">
                        <input type="submit" name="deconnexion" value="Déconnexion">
                      </form>';
            }
            ?>
        </div>
    </nav>

