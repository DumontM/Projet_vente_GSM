<?php
    // page où les GSM sont afficher
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
     * message de confirmation de la modification
     */
    if (isset($_SESSION['edition']))
    {
        $edition = $_SESSION['edition'];
        unset($_SESSION['edition']);
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
              <button type="button" class="close" data-dismiss="alert">&times;</button>Votre GSM a bien été modifié</div>';
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