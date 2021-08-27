<?php
    // page où les GSM sont afficher
    if(($_SESSION['typeCompte'] == 1) || ($_SESSION['typeCompte'] == 2) || ($_SESSION['typeCompte'] == 3))
    {
?>
<!-- <script> window.onload = rechercheSaisie()</script> -->

        <div class="container-fluid text-center">
            <div class="row-center">
                <header id="header" class="header">
                    <h1><?php echo $Titre ?></h1>
                </header>
            </div>

            <?php
            /**
             * si commande valider
             */
            if((isset($_SESSION['commandeOK'])))
            {
                echo '<p class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>Votre commande a bien été enregistré !</p>';
                unset($_SESSION['CommandeOK']);
            }

            /**
             * message de confirmation de la modification ou suppression
             */
            if (isset($_SESSION['edition']))
            {
                $edition = $_SESSION['edition'];
                unset($_SESSION['edition']);
                switch($edition)
                {
                    case 1: echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>Votre GSM a bien été modifié</div>'; break;
                    case 2: echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>Votre GSM a bien été supprimé</div>';break;
                }
            }
            ?>

            <div class="row-center">
                <section class="section text-center">
                    <article class="article text-center m-2">
                        <!-- recherche par modéles ou marques -->

                        <form name="RechercheGSM" id="RechercheGSM" method="POST" action="../Controller/GSM.php">
                            <label>Veuillez saisir votre rechercher : </label>
                            <input type="search" name="recherche" id="recherche" value="<?php if(isset($_POST["rechercheGSM"]))
                                                                                                {
                                                                                                    if($_POST["rechercheGSM"])
                                                                                                    {
                                                                                                        $_SESSION['rechercheGSM'] = $_POST['rechercheGSM'];
                                                                                                        $valueRecherche = $_SESSION["rechercheGSM"];
                                                                                                        unset ($_SESSION["rechercheGSM"]);
                                                                                                    }
                                                                                                } ?>"
                                   onkeyup="rechercheSaisie()" autofocus onfocus="rechercheVide()" placeholder="marque ou modèle"  class="">
                            <input type="submit" name="btnRecherche" id="btnRecherche" onclick="rechercheTrue()" value="Rechercher" class="btn btn-primary">
                        </form>
                    </article>
                </section>
            </div>

            <div class="row-center">
                <section class="section text-center">
                    <article class="article text-center">
                        <div id="messages">
                            <!-- les GSM-->
                        </div>
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